<?php
  class Payment extends Controller {

    public function __construct(){
        //Sees is the session user id is there to check if you are logged in (in able to only acces the page)
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->paymentDal = $this->dal('PaymentDAO');
        $this->paymentModel = $this->model('PaymentModel');
    }

    //Payment form
    public function index(){

        $data = [
            'title' => 'Payment Form'
        ];

        //Payment only works when the submit button is clicked
        if (!isset($_POST['submit'])) {
          redirect('index');
        }

        $this->ui('payment/payment', $data);
    }

    //When order is confirmed, show the succes page.
    public function success(){

        $data = [
            'title' => 'Payment Form',
        ];

        //Save user information in array
        foreach ($_SESSION['shoppingCart'] as $item) {
          $data = [
              'userId' => $_SESSION['userId'],
              'ticketId' => $item['ticketId'],
              'date' => $_SESSION['ticketDate'],
              'quantity' => $item['Quantity']

          ];

          //Insert sold ticket information in database with information above
          //Inside loop because you want to add more than one ticket
          $this->paymentDal->soldTickets($data);

        }
        $this->ui('payment/success', $data);
    }

    //Create invoice when ticket is sold.
    public function invoice() {
      $data = [
        'firstName' => $_SESSION['userName'],
        'lastName' => $_SESSION['userLastName'],
        'userStreet' => $_SESSION['userStreet'],
        'userHouse' => $_SESSION['userHouse'],
        'userEmail' => $_SESSION['userEmail'],
        'Phone' => $_SESSION['userPhone'],
      ];

      define('FPDF_FONTPATH',
       'file:///Applications/XAMPP/xamppfiles/htdocs/Systeemontwikkeling/app/libraries/pdf/font');

      ob_start();

      // create new PDF document
      $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);

      // set style for barcode
      $style = array(
          'border' => 2,
          'vpadding' => 'auto',
          'hpadding' => 'auto',
          'fgcolor' => array(0,0,0),
          'bgcolor' => false, //array(255,255,255)
          'module_width' => 1, // width of a single module in points
          'module_height' => 1 // height of a single module in points
      );

      //Set font to Helvetica
      $pdf->SetFont('helvetica', 'B', 20);

      // add a page
      $pdf->AddPage();

      //Line break
      $pdf->Ln();

      //Create QR code
      $pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', 10, 10, 50, 0, $style, 'N');

      //Information regarding user
      $pdf->Cell(0,40, 'Thank you, ' . $_SESSION['userName']);
      $pdf->Ln();
      $pdf->SetFont('helvetica', 'B', 14);
      $pdf->Cell(100,0, 'Customer information');
      $pdf->Ln();
      $pdf->SetFont('helvetica', '', 12);
      $pdf->Cell(100,20, 'Name: ' . $_SESSION['userName'] . " " . $_SESSION['userLastName']);
      $pdf->Ln();
      $pdf->Cell(100,0, 'Address: ' . $_SESSION['userStreet'] . " " . $_SESSION['userHouse']);
      $pdf->Ln();
      $pdf->Cell(100,20, 'E-mail: ' . $_SESSION['userEmail']);
      $pdf->Ln();
      $pdf->Cell(100,0, 'Phone: ' . $_SESSION['userPhone']);
      $pdf->Ln();
      $pdf->SetFont('helvetica', 'B', 14);

      //Order information user
      $pdf->Cell(100,40, 'You ordered the following products');
      $pdf->Ln();

      //Header table or order information
      $pdf->Cell(90, 10, 'Name', 1, 0, 'C');
      $pdf->Cell(50, 10, 'Quantity', 1, 0, 'C');
      $pdf->Cell(30, 10, 'Price', 1, 0, 'C');
      $pdf->Cell(30, 10, 'Total', 1, 0, 'C');
      $pdf->Ln();

      //Loop through cart items and shopping cart to get information about items
      foreach ($_SESSION['cartItems'] as $item) {
          foreach ($_SESSION['shoppingCart'] as $c) {
              $pdf->SetFont('helvetica', '', 12);
              $pdf->Cell(90,10, ' ' . $item['name'] . ' ', 1, 0, 'L');
              $pdf->Cell(50,10, ' ' . $c['Quantity'] . ' ', 1, 0, 'L');
              $pdf->Cell(30,10, ' ' . $item['price'] . ' ', 1, 0, 'L');
              $pdf->Cell(30,10, ' ' . $c['Quantity'] * $item['price'] . ' ', 1, 0, 'L');
          }
        $pdf->Ln();
      }

      //Close and output PDF document
     //$pdf->Output($path . '/' . $fileName . '.pdf', 'F');
     $pdf->Output($_SESSION['userName'] . '.pdf', 'D');
       //$pdf->Output('example_004.pdf', 'D');

     // $this->sendEmail($doc, $data);

      //Whenever PDF is send, unset shopping cart items and cart items because they are already sold
      unset($_SESSION['shoppingCart']);
      unset($_SESSION['cartItems']);

      $this->ui('payment/invoice', $data);
    }

    public function sendEmail($pdf, $data) {

      // Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
          //Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
          $mail->isSMTP();                                            // Send using SMTP
          $mail->Host       = 'smtp.mailtrap.io';                    // Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
          $mail->Username   = 'f4bb2974ea6f88';                     // SMTP username
          $mail->Password   = 'd2010d213636e0';                               // SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
          $mail->Port       = 2525;                                    // TCP port to connect to

          //Recipients
          $mail->setFrom('test@email.com', 'Test Form');
          $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient

          // Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'Here is the subject';
          $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

          $mail->send();
          echo 'Message has been sent';
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
}
}

<?php
/**
 * Template Name: Contact Form
 */
declare(strict_types=1);

require_once get_stylesheet_directory() . "/inc/classes/class-am-contact-form.php";
use AndrewMcCall\Classes\EmailForm;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ABSPATH . '/vendor/autoload.php';

$email_address = "";
$email_message = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["contact_nonce"]) && wp_verify_nonce($_POST['contact_nonce'], 'contact_action')) {
        if (isset($_POST["email_address"])) {
            $email_address = filter_var(trim($_POST["email_address"]), FILTER_SANITIZE_EMAIL);
        }

        if (isset($_POST["email_message"])) {
            $email_message = htmlspecialchars(trim($_POST["email_message"]));
        }

        // Validation
        if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
            $errors["email_address"] = "Invalid email provided";
        }

        if (empty($email_message)) {
            $errors["email_message"] = "Invalid message content";
        }

        if (count($errors) === 0) {
            // Send email
            $smtp_host = $_ENV["SMTP_HOST"] ?? "";
            $smtp_user = $_ENV["SMTP_USER"] ?? "";
            $smtp_pass = $_ENV["SMTP_PASS"] ?? "";
            $smtp_port = $_ENV["SMTP_PORT"] ?? "";

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = $smtp_host;
                $mail->SMTPAuth = true;
                $mail->Username = $smtp_user;
                $mail->Password = $smtp_pass;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = $smtp_port;

                $mail->setFrom($smtp_user, "Web Form Submission From maryfortuna.com");
                $mail->addAddress($_ENV["SMTP_TO"] ?? "");

                $mail->isHTML(true);
                $mail->Subject = $_ENV["SMTP_SUBJECT"] ?? "Contact Form Submission";
                $mail->Body = sprintf('<p><b>Email:</b> %s</p><p><b>Message:</b> %s</p>', $email_address, $email_message);
                $mail->AltBody = sprintf("Email: %s\nMessage: %s\n", $email_address, $email_message);
                
                $mail->send();
                // Redirect to success page
                wp_redirect(site_url('/success'));
                exit;
                
            } catch (Exception $e) {
                $errors["mail_error"] = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    } else {
        // Redirect if nonce verification fails
        wp_redirect(site_url("/contact"));
        exit;
    }
}

$form = new EmailForm($email_address, $email_message, $errors);
get_header();
?>

<main id="site-content" role="main">
    <div class="section-inner">
        <?php
        echo '<h1>' . get_the_title() . '</h1>';
        the_content();
        echo $form->build_form();
        ?>
    </div><!-- .section-inner -->
</main><!-- #site-content -->

<?php get_footer(); ?>


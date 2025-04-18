<?php

namespace AndrewMcCall\Classes;



class EmailForm {

public string $html = "";
private string $email_address = "";
private string $email_message = "";
private array $errors = [];

public function __construct(string $email_address = "", string $email_message = "", array $errors = []) {

    $this->email_address = esc_html($email_address);
    $this->email_message = esc_html($email_message);
    $this->errors = $errors;
}

public function build_form() {

$html = $this->html;
$html = "";
$html .= '<form action="/contact" method="post" class="" id="contactForm">';
$html .= wp_nonce_field('contact_action', 'contact_nonce');
// email address
$html .= '<div class="form-control">'; // start form-control
$html .= '<label for="emailAddress">Email: </label>';
$html .= '<input type="email" name="email_address" value="'.esc_html($this->email_address).'" id="emailAddress" />';
if (count($this->errors) > 0 && isset($this->errors["email_address"])) {
$html .= '<small class="error">'.$this->errors["email_address"].'</small>';
}
$html .= '</div>'; // end form-control

// message
$html .= '<div class="form-control">'; // start form-control
$html .= '<label for="emailMessage">Message: </label>'; // Changed "Email:" to "Message:"
$html .= '<textarea id="emailMessage" name="email_message">'.htmlspecialchars($this->email_message).'</textarea>';
if (count($this->errors) > 0 && isset($this->errors["email_message"])) {
$html .= '<small class="error">'.$this->errors["email_message"].'</small>';
}
$html .= '</div>'; // end form-control 

// submit
$html .= '<div class="form-control">'; // start form-control
$html .= '<label for="submitBtn">Submit: </label>';
$html .= '<input type="submit" value="Submit" />';
$html .= '</div>'; // end form-control 

$html .='</form>';

return $html;
}
}



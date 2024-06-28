<?php 
class ReportGenerator {
    public function generate() {
        // Code pour générer le rapport
        return "Report content";
    }
}

class EmailSender {
    public function send($report, $email) {
        // Code pour envoyer le rapport par email
        echo "Sending report to $email\n";
    }
}

class SmsSender {
    public function send($report, $phoneNumber) {
        // Code pour envoyer le rapport par SMS
        echo "Sending report to $phoneNumber\n";
    }
}

// Utilisation
$reportGenerator = new ReportGenerator();
$report = $reportGenerator->generate();

$emailSender = new EmailSender();
$emailSender->send($report, "example@example.com");

$smsSender = new SmsSender();
$smsSender->send($report, "123456789");

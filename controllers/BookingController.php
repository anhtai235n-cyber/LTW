<?php
require_once 'models/Booking.php';
require_once 'config/database.php';
require_once 'config/Logger.php';
class BookingController {
    private $db;
    public function __construct() {
        $database = new Database(); $this->db = $database->getConnection();
    }
    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bookingModel = new Booking($this->db);
            $bookingModel->tour_id = $_POST['tour_id'];
            $bookingModel->customer_name = trim($_POST['customer_name'] ?? '');
            $bookingModel->customer_phone = trim($_POST['customer_phone'] ?? '');
            $bookingModel->customer_email = trim($_POST['customer_email'] ?? '');
            $bookingModel->booking_date = $_POST['booking_date'];
            $bookingModel->guests = $_POST['guests'];
            $bookingModel->total_price = $_POST['total_price'];
            $bookingModel->payment_method = $_POST['payment_method'];
            $bookingModel->departure_location = trim($_POST['departure_location'] ?? '');
            $bookingModel->transport_method = trim($_POST['transport_method'] ?? '');
            $bookingModel->special_requests = trim($_POST['special_requests'] ?? '');
            $bookingModel->status = 'pending';

            if ($bookingModel->create()) {
                Logger::info("Booking created: tour={$bookingModel->tour_id}, email={$bookingModel->customer_email}, guests={$bookingModel->guests}");
                echo "<script>alert('Đặt tour thành công! Đội ngũ CloudJourney sẽ liên hệ với bạn sớm nhất.'); window.location.href='/index.php?url=home';</script>";
            } else {
                Logger::error("Booking failed: tour={$bookingModel->tour_id}, email={$bookingModel->customer_email}");
                echo "<script>alert('Có lỗi xảy ra. Vui lòng thử lại sau!'); window.history.back();</script>";
            }
        }
    }
}
?>
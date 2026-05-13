<?php
class Booking {
    private $conn;
    private $table_name = "bookings";
    public $id;
    public $tour_id;
    public $customer_name;
    public $customer_phone;
    public $customer_email;
    public $booking_date;
    public $guests;
    public $total_price;
    public $payment_method;
    public $departure_location;
    public $transport_method;
    public $special_requests;
    public $confirmation_message;
    public $status;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET tour_id=:tour_id, customer_name=:customer_name, customer_phone=:customer_phone, 
                      customer_email=:customer_email, booking_date=:booking_date, guests=:guests, 
                      total_price=:total_price, payment_method=:payment_method, departure_location=:departure_location, 
                      transport_method=:transport_method, special_requests=:special_requests, status=:status";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tour_id", $this->tour_id);
        $stmt->bindParam(":customer_name", $this->customer_name);
        $stmt->bindParam(":customer_phone", $this->customer_phone);
        $stmt->bindParam(":customer_email", $this->customer_email);
        $stmt->bindParam(":booking_date", $this->booking_date);
        $stmt->bindParam(":guests", $this->guests);
        $stmt->bindParam(":total_price", $this->total_price);
        $stmt->bindParam(":payment_method", $this->payment_method);
        $stmt->bindParam(":departure_location", $this->departure_location);
        $stmt->bindParam(":transport_method", $this->transport_method);
        $stmt->bindParam(":special_requests", $this->special_requests);
        $stmt->bindParam(":status", $this->status);
        return $stmt->execute();
    }

    public function readAll() {
        $query = "SELECT b.*, t.name as tour_name, t.tour_code 
                  FROM " . $this->table_name . " b
                  LEFT JOIN tours t ON b.tour_id = t.id
                  ORDER BY b.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            foreach ($row as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
            return true;
        }
        return false;
    }

    public function updateStatus() {
        $query = "UPDATE " . $this->table_name . " SET status=:status, confirmation_message=:confirmation_message WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":confirmation_message", $this->confirmation_message);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
?>
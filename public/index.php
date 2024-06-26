<?php
use Router\Router;

require '../vendor/autoload.php';

$url = $_GET['url'] ?? '/';

$router = new Router($url);

$router->get('/','BlogController@index');
$router->get('/posts/:id','App\Controllers\BlogController@shox');

$router->run();


try {
    $pdo = new PDO('mysql:host=localhost;dbname=arcadia', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT 
    u.id AS user_id,
    u.firstName AS user_firstName,
    u.lastName AS user_lastName,
    u.password AS user_password,
    u.email AS user_email,
    u.write_reports_id AS user_write_reports_id,
    r.id AS role_id,
    r.label AS role_label,
    vr.id AS veterinary_report_id,
    vr.animal_description,
    vr.animal_state,
    vr.food,
    vr.food_quantity,
    vr.last_check,
    vr.animal_details,
    s.id AS service_id,
    s.name AS service_name,
    s.description AS service_description,
    i.id AS image_id,
    i.image AS image_data,
    h.id AS habitat_id,
    h.title AS habitat_title,
    h.description AS habitat_description,
    h.comment_habitat AS habitat_comment,
    a.id AS animal_id,
    a.name AS animal_name,
    b.id AS breed_id,
    b.label AS breed_label,
    er.id AS employee_report_id,
    er.food AS employee_report_food,
    er.grammage AS employee_report_grammage,
    er.date_check AS employee_report_date_check
FROM 
    users u
    LEFT JOIN roles r ON u.roles_id = r.id
    LEFT JOIN veterinary_reports vr ON u.veterinary_reports_id = vr.id
    LEFT JOIN services s ON u.services_id = s.id
    LEFT JOIN images i ON i.id IN (
        SELECT DISTINCT includes.images_id FROM includes
    )
    LEFT JOIN habitats h ON h.id IN (
        SELECT DISTINCT consists.habitats_id FROM consists
    )
    LEFT JOIN animals a ON a.id IN (
        SELECT DISTINCT breeds.id FROM breeds
    )
    LEFT JOIN breeds b ON b.id = a.id
    LEFT JOIN emplyee_reports er ON er.id = a.id';


$stmt = $pdo->query($sql);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "User: " . $row['user_firstName'] . " " . $row['user_lastName'] . "<br>";
    echo "Email: " . $row['user_email'] . "<br>";
    echo "Role: " . $row['role_label'] . "<br>";
    echo "Veterinary Report - Description: " . $row['animal_description'] . ", State: " . $row['animal_state'] . "<br>";
    echo "Service: " . $row['service_name'] . "<br>";
    echo "Image: " . $row['image_data'] . "<br>";
    echo "Habitat: " . $row['habitat_title'] . "<br>";
    echo "Animal: " . $row['animal_name'] . "<br>";
    echo "Breed: " . $row['breed_label'] . "<br>";
    echo "Employee Report - Food: " . $row['employee_report_food'] . ", Grammage: " . $row['employee_report_grammage'] . ", Date: " . $row['employee_report_date_check'] . "<br>";
    echo "<hr>";
}


} catch (PDOException $e) {
    echo 'Impossible de récupérer la liste des utilisateurs' . $e->getMessage();
}

<?php if (isset($_POST['insert_row'])) {
    $sql = $conn->prepare("INSERT INTO tbl_comments (name,website,content) VALUES (?, ?, ?)");
    $name = $_POST['name'];
    $website = $_POST['website'];
    $content = $_POST['content'];
    $sql->bind_param("sss", $name, $website, $content);
    if ($sql->execute()) {
        $success_message = "Added Successfully";
    } else {
        $error_message = "Problem in Adding New Record";
    }
    $sql->close();
    $conn->close();
    exit();
}
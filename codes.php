<?php
session_start();
include('config/dbcons.php');
include('includes/headers.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/script.php');
?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <?php
                if (isset($_POST["addcategory_head"])) {
                    $name = $_POST['c_h_name'];
                    $filename = $_FILES["file"]["name"];
                    $tempname = $_FILES["file"]["tmp_name"];
                    $folder = "image/" . mt_rand(10, 100000000) . $filename;
                    move_uploaded_file($tempname, $folder);

                    $query = "INSERT INTO category_head (c_image,c_h_name) VALUES ('$folder','$name')";
                    $query_r = mysqli_query($con, $query);

                    if ($query_r) {

                        //header("Location: category_register.php");
                    } else {
                        echo "Something Wrong";
                    }
                }

                if (isset($_POST['updates'])) {

                    $id = intval($_POST['id']);
                    $name = mysqli_real_escape_string($con, $_POST['c_h_name']);


                    $folder = $_POST['file_old'];

                    if (isset($_FILES["file"]["name"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
                        $filename = basename($_FILES["file"]["name"]);
                        $tempname = $_FILES["file"]["tmp_name"];
                        $uploadDir = 'image/';
                        $folder = $uploadDir . $filename;


                        if (!move_uploaded_file($tempname, $folder)) {
                            echo "Failed to upload file.";
                            exit;
                        }
                    }


                    $stmt = $con->prepare("UPDATE category_head SET c_image=?, c_h_name=? WHERE id=?");
                    $stmt->bind_param("ssi", $folder, $name, $id);

                    if ($stmt->execute()) {

                        // header("Location: mobile.php");
                        exit;
                    } else {

                        //header("Location: index.php");
                        exit;
                    }


                }




                if (isset($_POST["delete_btnss"])) {
                    $del_id = $_POST["delete"];
                    $reg_query = "DELETE FROM category_head WHERE id='$del_id'";
                    $result = mysqli_query($con, $reg_query);
                    if ($result) {
                        // header("Location:view_category.php");
                    } else {
                        header("Location:view_category.php");
                    }
                }


                
                if (isset($_POST["addcategory"])) {
                    $name = $_POST['c_name'];
                    $c_h_names = $_POST['c_h_names'];
                    $filename = $_FILES["file"]["name"];
                    $tempname = $_FILES["file"]["tmp_name"];
                    $folder = "image/" . mt_rand(10, 100000000) . $filename;
                    move_uploaded_file($tempname, $folder);

                    $query = "INSERT INTO category (c_image,c_name,c_h_names) VALUES ('$folder','$name','$c_h_names')";
                    $query_r = mysqli_query($con, $query);

                    if ($query_r) {

                        //header("Location: category_register.php");
                    } else {
                        echo "Something Wrong";
                    }
                }

                if (isset($_POST['update'])) {

                    $id = intval($_POST['id']);
                    $name = mysqli_real_escape_string($con, $_POST['c_name']);


                    $folder = $_POST['file_old'];

                    if (isset($_FILES["file"]["name"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
                        $filename = basename($_FILES["file"]["name"]);
                        $tempname = $_FILES["file"]["tmp_name"];
                        $uploadDir = 'image/';
                        $folder = $uploadDir . $filename;


                        if (!move_uploaded_file($tempname, $folder)) {
                            echo "Failed to upload file.";
                            exit;
                        }
                    }


                    $stmt = $con->prepare("UPDATE category SET c_image=?, c_name=? WHERE id=?");
                    $stmt->bind_param("ssi", $folder, $name, $id);

                    if ($stmt->execute()) {

                        // header("Location: mobile.php");
                        exit;
                    } else {

                        //header("Location: index.php");
                        exit;
                    }


                }




                if (isset($_POST["delete_btns"])) {
                    $del_id = $_POST["delete"];
                    $reg_query = "DELETE FROM category WHERE id='$del_id'";
                    $result = mysqli_query($con, $reg_query);
                    if ($result) {
                        // header("Location:view_category.php");
                    } else {
                        header("Location:view_category.php");
                    }
                }



                if (isset($_POST["addproduct"])) {
                    $cat_name = $_POST['cat_name'];
                    $pname = $_POST['p_name'];
                    $a_number = $_POST['article_number'];
                    $p_size = $_POST['p_size'];
                    $filename = $_FILES["file"]["name"];
                    $tempname = $_FILES["file"]["tmp_name"];
                    $folder = "p_image/" . mt_rand(10, 100000000) . $filename;
                    move_uploaded_file($tempname, $folder);

                    $query = "INSERT INTO c_product (cat_name,p_name,article_number,p_size,p_image) VALUES ('$cat_name','$pname','$a_number','$p_size','$folder')";
                    $query_r = mysqli_query($con, $query);

                    if ($query_r) {

                        //header("Location: category_register.php");
                    } else {
                        echo "Something Wrong";
                    }
                }


                //Replace image and File
                if (isset($_POST["update_product"])) {
                    $id = $_POST['id'];

                    $pname = $_POST['p_name'];
                    $a_number = $_POST['article_number'];
                    $p_size = $_POST['p_size'];
                    $filename = $_FILES["file"]["name"];
                    $tempname = $_FILES["file"]["tmp_name"];


                    if (isset($_FILES["file"]["name"])) {
                        $filename = $_FILES["file"]["name"];
                        $tempname = $_FILES["file"]["tmp_name"];
                        $folder = $_POST['file_old'];

                        move_uploaded_file($tempname, $folder);
                    } else {
                        $folder = $_POST['file_old'];
                    }



                    $qu_up = "UPDATE c_product SET p_name='$pname', article_number='$a_number', p_size='$p_size', p_image='$folder' WHERE id='$id'";
                    $query_edit_run = mysqli_query($con, $qu_up);
                    if ($query_edit_run) {
                        // header("Location:index.php");
                    } else {

                        header("Location:view_product.php");
                    }
                }





                if (isset($_POST["delete_btnss"])) {
                    $del_id = $_POST["delete"];
                    $reg_query = "DELETE FROM c_product WHERE id='$del_id'";
                    $result = mysqli_query($con, $reg_query);
                    if ($result) {
                        // header("Location:view_category.php");
                    } else {
                        header("Location:view_product.php");
                    }
                }



                if (isset($_POST["addproduct_details"])) {
                    $p_name = $_POST["p_name"];
                    $cats_name=$_POST["cats_name"];
                    $pd_name = $_POST["pdname"];
                    $p_color = $_POST["p_color"];
                    $p_price = $_POST["p_price"];
                    $p_size = $_POST["p_size"];
                    $p_off_price = $_POST["p_off_price"];
                    $p_p_discount = $_POST["p_p_discount"];
                    $p_delivery = $_POST["p_delivery"];
                    $p_deal = $_POST["p_deal"];
                    $filename = $_FILES["files"]["name"];
                    $tempnames = $_FILES["files"]["tmp_name"];
                    $folder = "pd_image/" . mt_rand(10, 1000000) . $filename;
                    move_uploaded_file($tempnames, $folder);

                    $query = "INSERT INTO p_details (p_name, cats_name, pdname, p_color, p_price, p_size, p_off_price, p_p_discount, p_delivery, p_deal, pd_image) 
                    VALUES ('$p_name','$cats_name','$pd_name','$p_color','$p_price','$p_size','$p_off_price','$p_p_discount','$p_delivery','$p_deal','$folder')";
                    $query_r = mysqli_query($con, $query);
                    if ($query_r) {

                    } else {
                        echo 'Not Inserted';
                    }
                }


                if (isset($_POST['update_product_details'])) {
                    // Sanitize and assign variables
                    $id = $_POST["id"];
                    $p_name = $_POST["p_name"];
                    
                    $pd_name = $_POST["pdname"];
                    $p_color = $_POST["p_color"];
                    $p_price = $_POST["p_price"];
                    $p_size = $_POST["p_size"];
                    $p_off_price = $_POST["p_off_price"];
                    $p_p_discount = $_POST["p_p_discount"];
                    $p_delivery = $_POST["p_delivery"];
                    $p_deal = $_POST["p_deal"];

                    // Handle file upload
                    $folder = $_POST['files_old']; // Default to old file path
                    if (isset($_FILES["files"]) && $_FILES["files"]["error"] === UPLOAD_ERR_OK) {
                        $filename = $_FILES["files"]["name"];
                        $tempname = $_FILES["files"]["tmp_name"];
                        $target_path = "pd_image/" . basename($filename); // Specify your upload directory
                
                        if (move_uploaded_file($tempname, $target_path)) {
                            $folder = $target_path; // Use new file path if upload is successful
                        } else {
                            echo 'File upload failed';
                            exit; // Stop further execution
                        }
                    }

                    // Prepare the SQL query with prepared statements
                    $stmt = $con->prepare("UPDATE p_details SET p_name=?,  pdname=?, p_color=?, p_price=?, p_size=?, p_off_price=?, p_p_discount=?, p_delivery=?, p_deal=?, pd_image=? WHERE id=?");
                    $stmt->bind_param("ssssssssssi", $p_name, $pd_name, $p_color, $p_price, $p_size, $p_off_price, $p_p_discount, $p_delivery, $p_deal, $folder, $id);

                    // Execute the query
                    if ($stmt->execute()) {
                        echo 'Product details updated successfully.';
                    } else {
                        echo 'Error updating product details: ' . $stmt->error;
                    }

                    $stmt->close();
                }




                if (isset($_POST["delete_btn_p"])) {
                    $del_id = $_POST["delete"];
                    $reg_query = "DELETE FROM p_details WHERE id='$del_id'";
                    $result = mysqli_query($con, $reg_query);
                    if ($result) {
                        // header("Location:view_category.php");
                    } else {
                        header("Location:view_product.php");
                    }
                }



                if (isset($_POST["add_f_category"])) {
                    $f_name = $_POST["f_c_name"];

                    $query = "INSERT INTO add_f_category (f_c_name) VALUES ('$f_name')";
                    $query_run = mysqli_query($con, $query);
                    if ($query_run) {
                        //header ("Location: adds_f_category.php");
                    } else {
                        echo "Data Not Inserted";
                    }
                }

                if (isset($_POST["update_f_category"])) {
                    $id = $_POST["id"];
                    $f_name = $_POST["f_c_name"];

                    $query = "UPDATE  add_f_category SET f_c_name='$f_name' WHERE id = '$id'";
                    $query_edit_run = mysqli_query($con, $query);
                    if ($query_edit_run) {
                        echo "Data Updated Successful";
                    } else {
                        echo "Data Not Updated";
                    }
                }

                if (isset($_POST["delete_btn"])) {
                    $del_id = $_POST["delete"];
                    $reg_query = "DELETE FROM add_f_category WHERE id='$del_id'";
                    $result = mysqli_query($con, $reg_query);
                    if ($result) {

                    } else {
                        header("Location:view_f_category.php");
                    }
                }

                if (isset($_POST["add_f_product"])) {
                    $f_c_name = $_POST["f_c_name"];
                    $f_p_name = $_POST["f_p_name"];

                    $query = "INSERT INTO add_f_product (f_c_name,f_p_name) VALUES ('$f_c_name','$f_p_name')";
                    $query_edit_run = mysqli_query($con, $query);
                    if ($query_edit_run) {
                        //header ("Location: adds_f_category.php");
                    } else {
                        echo "Fashion Product Not Added";
                    }
                }

                if (isset($_POST["update_f_product"])) {
                    $id = $_POST["id"];
                    $f_p_name = $_POST["f_p_name"];
                    $query = "UPDATE add_f_product SET f_p_name='$f_p_name' WHERE id='$id'";
                    $query_edit_run = mysqli_query($con, $query);
                    if ($query_edit_run) {
                        echo "Fashion Product Updated Successfull";
                    } else {
                        echo "Fashion Product Not Updated";
                    }
                }

                if (isset($_POST["delete_btn"])) {
                    $del_id = $_POST["delete"];
                    $reg_query = "DELETE FROM add_f_product WHERE id='$del_id'";
                    $result = mysqli_query($con, $reg_query);
                    if ($result) {
                        // header("Location:view_category.php");
                    } else {
                        header("Location:view_f_product.php");
                    }
                }


                if (isset($_POST["add_f_product_details"])) {
                    $f_p_name = $_POST['f_p_name'];
                    $p_c_name = $_POST['p_c_name'];
                    $pdname = $_POST['pdname'];
                    $p_color = $_POST['p_color'];
                    $p_price = $_POST['p_price'];
                    $p_size = $_POST['p_size'];
                    $p_off_price = $_POST['p_off_price'];
                    $p_p_discount = $_POST['p_p_discount'];
                    $p_delivery = $_POST['p_delivery'];
                    $p_deal = $_POST['p_deal'];
                    $filename = $_FILES["files"]["name"];
                    $tempname = $_FILES["files"]["tmp_name"];
                    $folder = 'image/f_image/' . mt_rand(10, 100000) . $filename;
                    move_uploaded_file($tempname, $folder);

                    $query = "INSERT INTO add_f_product_details (f_p_name,p_c_name,pdname,p_color,p_price,p_size,p_off_price,p_p_discount,p_delivery,p_deal,f_image) VALUES 
                    ('$f_p_name','$p_c_name','$pdname','$p_color','$p_price','$p_size','$p_off_price','$p_p_discount','$p_delivery','$p_deal','$folder')";

                    $query_run = mysqli_query($con, $query);
                    if ($query_run) {
                        echo "Fashion product details added";
                    } else {
                        echo "Fashion Product did not added";
                    }

                }

                if (isset($_POST["update_f_p_details"])) {
                    $id = $_POST['id'];
                    $p_c_name = $_POST['p_c_name'];
                    $pdname = $_POST['pdname'];
                    $p_color = $_POST['p_color'];
                    $p_price = $_POST['p_price'];
                    $p_size = $_POST['p_size'];
                    $p_off_price = $_POST['p_off_price'];
                    $p_p_discount = $_POST['p_p_discount'];
                    $p_delivery = $_POST['p_delivery'];
                    $p_deal = $_POST['p_deal'];


                    $filename = $_FILES["files"]["name"];
                    $tempname = $_FILES["files"]["tmp_name"];


                    $folder = $_POST['file_old'];


                    if (!empty($filename)) {

                        move_uploaded_file($tempname, $folder);
                    }
                    $query = "UPDATE add_f_product_details SET p_c_name=?, pdname=?, p_color=?, p_price=?, 
                              p_size=?, p_off_price=?, p_p_discount=?, p_delivery=?, p_deal=?, f_image=? 
                              WHERE id=?";
                    $stmt = $con->prepare($query);

                    $stmt->bind_param(
                        "ssssssssssi",
                        $p_c_name,
                        $pdname,
                        $p_color,
                        $p_price,
                        $p_size,
                        $p_off_price,
                        $p_p_discount,
                        $p_delivery,
                        $p_deal,
                        $folder,
                        $id
                    );


                    if ($stmt->execute()) {
                        echo "Product Details updated";
                    } else {
                        echo "Product Details Not updated: " . $stmt->error;
                    }

                    // Close the statement
                    $stmt->close();
                }


                if (isset($_POST["delete_btn"])) {
                    $del_id = $_POST["delete"];
                    $reg_query = "DELETE FROM add_f_product_details WHERE id='$del_id'";
                    $result = mysqli_query($con, $reg_query);
                    if ($result) {
                        // header("Location:view_category.php");
                    } else {
                        header("Location:view_f_product.php");
                    }
                }

                //Registration page//
                



              




                ?>




            </div>
        </div>
    </section>
</div>

<?php
session_start();
include("assets/e-commerce_includefile/navbar.php");
include("assets/e-commerce_includefile/header.php");
include("config/dbcons.php");
?>

<style>
    .zoom-container {
        position: relative;
        width: 400px;
        height: 400px;
        overflow: hidden;
        cursor: crosshair;
    }

    .zoom-container img {
        transition: transform 0.2s ease;
        width: 100%;
        height: auto;
    }
    .position-relative {
        position: relative;
    }

    .share-icon {
        
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .share-menu {
        
        display: none;
        position: absolute;
        background: white;
        border: 1px solid #ddd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 5px;
        border-radius: 5px;
        z-index: 1000;
    }

    .share-link {
    display: block; /* Ensure links can have width and height */
    width: 40px;
    height: 40px;
    margin: 11px 20px; /* Adjust spacing as needed */
    text-decoration: none; /* Remove underline */
}

.share-link i {
    font-size: 30px; /* Set icon size */
    color: inherit; /* Use inherited color */
    line-height: 30px; /* Center the icon vertically */
}


    .share-icon:hover .share-menu {
        display: block;
    }
    .text-brown {
    color: brown; /* Change this to your desired shade of brown */
}

.btn-link {
    text-decoration: none; /* Remove underline from links */
    color: inherit; /* Inherit color from parent */
}

.btn-link:hover {
    text-decoration: none; /* Ensure no underline on hover */
}

</style>

<div class="container mt-5">
    <h2>Product Details</h2>
    <div class="row">
        <?php
        if (isset($_GET['product_id'])) {
            $product_id = intval($_GET['product_id']);
            $query = "SELECT * FROM p_details WHERE id=?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'i', $product_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                ?>
                <div class="col-md-6">
                    <div class="zoom-container">
                        <img src="<?php echo htmlspecialchars($row['pd_image']); ?>" class="img-fluid"
                            alt="<?php echo htmlspecialchars($row['p_name']); ?>" onmousemove="showZoom(event, this.src)"
                            onmouseleave="closeZoom()">
                    </div>
                </div>
                <div class="col-md-6">
    <div class="card-body position-relative">
        <!-- Share Button Container -->
        <div class="share-icon mb-4">
            <button class="btn btn-outline-secondary btn-sm" onclick="toggleShareMenu(this)">
                <i class="fas fa-share-alt"></i>
            </button>
            <div class="share-menu">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://yourwebsite.com/product.php?id=' . $row['id']); ?>" target="_blank" class="share-link">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($row['pdname'] . ' - ' . 'https://yourwebsite.com/product.php?id=' . $row['id']); ?>" target="_blank" class="share-link">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="mailto:?subject=<?php echo urlencode($row['pdname']); ?>&body=<?php echo urlencode('Check out this product: https://yourwebsite.com/product.php?id=' . $row['id']); ?>" class="share-link">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>
        </div>

        <h5 class="card-title mt-3"><?php echo htmlspecialchars($row['pdname']); ?></h5>
        <p class="card-text"><strong>Color:</strong>
            <span class="badge" style="background-color: <?php echo htmlspecialchars($row['p_color']); ?>;">
                <?php echo htmlspecialchars($row['p_color']); ?>
            </span>
        </p>
        <p class="card-text"><strong>Price:</strong> ₹<?php echo htmlspecialchars($row['p_price']); ?></p>
        <p class="card-text"><strong>Off Price:</strong>
            <del>₹<?php echo htmlspecialchars($row['p_off_price']); ?></del>
        </p>
        <p class="card-text"><strong>Discount:</strong> <?php echo htmlspecialchars($row['p_p_discount']); ?> off</p>
        <p class="card-text"><strong>Size:</strong> <?php echo htmlspecialchars($row['p_size']); ?></p>
        <p class="card-text"><strong>Delivery:</strong> <?php echo htmlspecialchars($row['p_delivery']); ?></p>
        <p class="card-text offer"><i><?php echo htmlspecialchars($row['p_deal']); ?></i></p>

        <!-- Pincode Input Section -->
        <div class="pincode-section mt-3">
    <input type="text" id="pincode" class="form-control" placeholder="Enter your pincode" maxlength="6">
    <button class="btn btn-secondary btn-sm mt-2" onclick="checkDelivery()">Check Delivery</button>
    <div id="delivery-message" class="mt-2"></div>
</div>

        <button class="btn btn-primary btn-sm" onclick="addToCart('<?php echo htmlspecialchars($row['id']); ?>')">Add to Cart</button>

        <?php if (isset($_SESSION['user_data'])): ?>
            <button class="btn btn-success btn-sm" onclick="buyNow('<?php echo htmlspecialchars($row['id']); ?>')">Buy Now</button>
        <?php else: ?>
            <button class="btn btn-success btn-sm" onclick="redirectToLogin()">Buy Now</button>
        <?php endif; ?>
    </div>
</div>

                <?php
            } else {
                echo '<div class="col-12"><div class="alert alert-warning">No Product Found</div></div>';
            }
        } else {
            echo '<div class="col-12"><div class="alert alert-warning">No Product Selected</div></div>';
        }
        ?>
    </div>

    <div class="row mt-4">
        <div class="col-md-5"></div>
        <div class="col-md-7">
            <h3>Ask a Question</h3>
            <?php if (isset($_SESSION['user_data'])): ?>
                <form id="commentForm" onsubmit="submitComment(event)">
                    <div class="form-group">
                        <label for="commentText">Your Question</label>
                        <textarea id="commentText" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <div id="commentFeedback" class="mt-2"></div>
                </form>
            <?php else: ?>
                <div class="alert alert-info">You must be logged in to ask a question.</div>
            <?php endif; ?>

            <h3>Existing Questions</h3>
            <div id="existingComments">
                <?php
                $commentQuery = "SELECT pc.*, r.name AS user_name 
                                 FROM product_comments pc 
                                 JOIN registration r ON pc.user_id = r.id 
                                 WHERE pc.product_id = ? AND pc.is_active = 1";
                $stmt = mysqli_prepare($con, $commentQuery);
                mysqli_stmt_bind_param($stmt, 'i', $product_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    $questionNumber = 1; // Initialize question counter
                    while ($commentRow = mysqli_fetch_assoc($result)) {
                        // Count replies for each question
                        $replyCountQuery = "SELECT COUNT(*) as total_replies FROM comment_replies WHERE comment_id = ? AND is_active = 1";
                        $replyCountStmt = mysqli_prepare($con, $replyCountQuery);
                        if ($replyCountStmt) {
                            mysqli_stmt_bind_param($replyCountStmt, 'i', $commentRow['id']);
                            mysqli_stmt_execute($replyCountStmt);
                            $replyCountResult = mysqli_stmt_get_result($replyCountStmt);

                            if ($replyCountResult) {
                                $replyCountRow = mysqli_fetch_assoc($replyCountResult);
                                $totalReplies = $replyCountRow['total_replies'];
                            } else {
                                echo "Error retrieving reply count: " . mysqli_error($con);
                                $totalReplies = 0;
                            }
                            mysqli_stmt_close($replyCountStmt);
                        } else {
                            echo "Error preparing statement: " . mysqli_error($con);
                            $totalReplies = 0;
                        }
                        ?>
                        <h6><?php echo $questionNumber++; ?>. Question</h6>
                        <div class="alert alert-secondary">
                            <strong><?php echo htmlspecialchars($commentRow['user_name']); ?>:</strong>
                            <?php echo htmlspecialchars($commentRow['comment']); ?>
                            <span class="badge badge-info"><?php echo $totalReplies; ?> Replies</span>
                        </div>
                        <?php
                        // Reply button
                        if (isset($_SESSION['user_data'])) {
                            echo '<button class="btn btn-secondary btn-sm mt-2" onclick="toggleReplyForm(this)">Reply</button>';
                            echo '<form class="mt-2 reply-form" style="display: none;" onsubmit="submitReply(event, ' . $commentRow['id'] . ')">';
                            echo '<div class="form-group">';
                            echo '<textarea class="form-control" placeholder="Reply..." required></textarea>';
                            echo '</div>';
                            echo '<button type="submit" class="btn btn-primary">Submit</button>';
                            echo '</form>';
                        } else {
                            echo '<div class="alert alert-info">You must be logged in to reply.</div>';
                        }

                        // Fetch replies for each comment
                        $replyQuery = "SELECT cr.*, r.name AS user_name,
                        (SELECT COUNT(*) FROM reply_votes WHERE reply_id = cr.id AND vote = 'like') AS like_count,
                        (SELECT COUNT(*) FROM reply_votes WHERE reply_id = cr.id AND vote = 'dislike') AS dislike_count
                        FROM comment_replies cr 
                        JOIN registration r ON cr.user_id = r.id 
                        WHERE cr.comment_id = ? AND cr.is_active = 1";
                        $replyStmt = mysqli_prepare($con, $replyQuery);
                        mysqli_stmt_bind_param($replyStmt, 'i', $commentRow['id']);
                        mysqli_stmt_execute($replyStmt);
                        $replyResult = mysqli_stmt_get_result($replyStmt);
                        ?>
                        <h6 class="mt-2">Answers (<?php echo $totalReplies; ?>)</h6>
                        <?php
                        if (mysqli_num_rows($replyResult) > 0) {
                            while ($replyRow = mysqli_fetch_assoc($replyResult)) {
                                $userVoteQuery = "SELECT vote FROM reply_votes WHERE reply_id = ? AND user_id = ?";
                                $voteStmt = mysqli_prepare($con, $userVoteQuery);
                                mysqli_stmt_bind_param($voteStmt, 'ii', $replyRow['id'], $_SESSION['user_data']['id']);
                                mysqli_stmt_execute($voteStmt);
                                $voteResult = mysqli_stmt_get_result($voteStmt);
                                $userVote = mysqli_fetch_assoc($voteResult);

                                $likeActive = ($userVote['vote'] === 'like') ? 'active' : '';
                                $dislikeActive = ($userVote['vote'] === 'dislike') ? 'active' : '';

                                echo '<div class="alert alert-light d-flex justify-content-between align-items-center">';
                                echo '<div>';
                                echo '<strong>' . htmlspecialchars($replyRow['user_name']) . ':</strong> ';
                                echo htmlspecialchars($replyRow['reply']);
                                echo '</div>';
                                echo '<div style="display: flex; align-items: center;">';
                                echo '<button class="btn btn-link text-brown p-0" onclick="voteReply(' . $replyRow['id'] . ', \'like\')"><i class="fas fa-thumbs-up"></i></button>';
                                echo '<span class="mx-1">' . $replyRow['like_count'] . '</span>';
                                echo '<button class="btn btn-link text-brown p-0" onclick="voteReply(' . $replyRow['id'] . ', \'dislike\')"><i class="fas fa-thumbs-down"></i></button>';
                                echo '<span class="mx-1">' . $replyRow['dislike_count'] . '</span>';

                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div class="alert alert-info ml-4">No replies yet.</div>';
                        }
                    }
                } else {
                    echo '<div class="alert alert-info">No questions yet.</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    let zoomWindow;

    function showZoom(event, imageSrc) {
        if (!zoomWindow || zoomWindow.closed) {
            const rect = event.target.getBoundingClientRect();
            const offsetX = event.clientX - rect.left;
            const offsetY = event.clientY - rect.top;

            const windowWidth = 800;
            const windowHeight = 600;

            const left = window.screenX + event.screenX + 20;
            const top = window.screenY + event.screenY - windowHeight / 2;

            zoomWindow = window.open("", "_blank", `width=${windowWidth},height=${windowHeight},left=${left},top=${top}`);
            zoomWindow.document.write(`
                <html>
                <head>
                    <title>Zoomed Image</title>
                    <style>
                        body {
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                            margin: 0;
                            background-color: #f0f0f0;
                            overflow: hidden;
                        }
                        img {
                            max-width: none;
                            transition: transform 0.2s ease;
                            cursor: crosshair;
                        }
                    </style>
                </head>
                <body>
                    <img id="zoomed-img" src="${imageSrc}" alt="Zoomed Image">
                </body>
                </html>
            `);
            zoomWindow.document.close();

            setTimeout(closeZoom, 20000);
        }

        const zoomedImg = zoomWindow.document.getElementById('zoomed-img');
        const scaleFactor = 2;

        const zoomedX = (offsetX * scaleFactor) - (zoomWindow.innerWidth / 2);
        const zoomedY = (offsetY * scaleFactor) - (zoomWindow.innerHeight / 2);

        zoomedImg.style.transform = `translate(${-zoomedX}px, ${-zoomedY}px) scale(${scaleFactor})`;
    }

    function closeZoom() {
        if (zoomWindow) {
            zoomWindow.close();
            zoomWindow = null;
        }
    }

    function redirectToLogin() {
        window.location.href = 'login.php';
    }

    function buyNow(productId) {
        window.location.href = 'buy_now.php?product_id=' + productId;
    }

    function addToCart(productId) {
        const userLoggedIn = <?php echo json_encode(isset($_SESSION['user_data'])); ?>;

        const data = new FormData();
        data.append('action', 'add_to_cart');
        data.append('product_id', productId);

        fetch('add_to_cart.php', {
            method: 'POST',
            body: data,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (userLoggedIn) {
                    window.location.href = 'user_profile.php';
                } else {
                    alert('Item added to temporary cart. You can view it in your cart.');
                    window.location.href = 'cart.php';
                }
            } else {
                alert('Failed to add item to cart: ' + (data.message || 'Unknown error.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }

    function submitComment(event) {
        event.preventDefault();

        const commentText = document.getElementById('commentText').value.trim().replace(/[\r\n]+/g, ' ');
        const productId = <?php echo json_encode($product_id); ?>;

        const data = new FormData();
        data.append('action', 'submit_comment');
        data.append('comment', commentText);
        data.append('product_id', productId);

        fetch('submit_comment.php', {
            method: 'POST',
            body: data,
        })
        .then(response => response.json())
        .then(data => {
            const feedback = document.getElementById('commentFeedback');
            if (data.success) {
                feedback.innerHTML = '<div class="alert alert-success">Comment submitted successfully!</div>';
                document.getElementById('commentText').value = '';
                location.reload();
            } else {
                feedback.innerHTML = '<div class="alert alert-danger">Error: ' + (data.message || 'Unknown error.') + '</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }

    function submitReply(event, commentId) {
        event.preventDefault();

        const replyText = event.target.querySelector('textarea').value.trim().replace(/[\r\n]+/g, ' ');
        const data = new FormData();
        data.append('action', 'submit_reply');
        data.append('comment_id', commentId);
        data.append('reply', replyText);

        fetch('submit_reply.php', {
            method: 'POST',
            body: data,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Reply submitted successfully!');
                location.reload();
            } else {
                alert('Error: ' + (data.message || 'Unknown error.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }

    function toggleReplyForm(button) {
        const replyForm = button.nextElementSibling; // Get the next sibling form
        replyForm.style.display = replyForm.style.display === 'none' || replyForm.style.display === '' ? 'block' : 'none';
    }

    function voteReply(replyId, voteType) {
        const data = new FormData();
        data.append('action', 'vote_reply');
        data.append('reply_id', replyId);
        data.append('vote', voteType);

        fetch('vote_reply.php', {
            method: 'POST',
            body: data,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + (data.message || 'Unknown error.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }

    function checkDelivery() {
        // Get the entered pincode
        const pincode = document.getElementById('pincode').value.trim();
        
        // Check if the pincode is empty
        if (pincode === "") {
            alert('Please enter a pincode.');
            return;
        }

        // Validate pincode format (only 6 digits)
        if (!/^\d{6}$/.test(pincode)) {
            alert('Please enter a valid 6-digit pincode.');
            return;
        }

        // Send the pincode to the server via AJAX
        const formData = new FormData();
        formData.append('pincode', pincode);

        fetch('check_delivery.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Display the message returned from the server
            document.getElementById('delivery-message').innerText = data.message;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
</script>

<?php
include("assets/e-commerce_includefile/footer.php");
?>

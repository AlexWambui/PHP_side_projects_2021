<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['update_book'])) update_book();
?>
<!doctype html>
<html lang="en"a>
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Book | update</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">
                <div class="card">
                    <h5 class="card-header text-center">Update Book</h5>
                    <div class="card-body">
                        <?php foreach(fetch_this_row('books') as $book): ?>
                            <form action="./update_book.php" method="post">
                                <input type="hidden" name="update_id" value="<?= $book['id'] ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select name="category" id="category" class="form-control validate" required>
                                                <option value="romance">Romance</option>
                                                <option value="fiction">Fiction</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="title">Book Title</label>
                                            <input type="text" name="title" id="title"
                                                   class="form-control validate"
                                                   placeholder="Book Title" value="<?= $book['title'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input type="text" name="author" id="author"
                                           class="form-control validate" placeholder="Author" value="<?= $book['author'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" id="description"
                                           class="form-control validate" placeholder="Description" value="<?= $book['description'] ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price"
                                           class="form-control validate" placeholder="Price" value="<?= $book['price'] ?>" required>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success" name="update_book">Update</button>
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>


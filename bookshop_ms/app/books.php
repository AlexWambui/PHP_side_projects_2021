<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['save_book'])) add_book();
if (isset($_POST['delete_book'])) delete_book();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Books</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="main_content">
    <div class="container">
        <div class="row justify-content-center pt-3">
            <div class="col">
                <?= alert() ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Books</h5>
                            </div>
                            <div class="col text-right">
                                <div class="modal fade" id="modalAddPayment" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h4 class="modal-title w-100 font-weight-bold">Add a Book</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form action="./books.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="category">Category</label>
                                                                <select name="category" id="category" class="form-control validate" required>
                                                                    <option value="action_and_adventure">Action And Adventure</option>
                                                                    <option value="bio_and_autobiographies">Biographies and Autobiographies</option>
                                                                    <option value="classics">Classics</option>
                                                                    <option value="detective_and_mystery">Detective and Mystery</option>
                                                                    <option value="fantasy">Fantasy</option>
                                                                    <option value="fiction">Fiction</option>
                                                                    <option value="history">History</option>
                                                                    <option value="horror">Horror</option>
                                                                    <option value="poetry">Poetry</option>
                                                                    <option value="romance">Romance</option>
                                                                    <option value="self_help">Self Help</option>
                                                                    <option value="short_stories">Short Stories</option>
                                                                    <option value="thrillers">Thrillers</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="title">Book Title</label>
                                                                <input type="text" name="title" id="title"
                                                                       class="form-control validate"
                                                                       placeholder="Book Title" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="author">Author</label>
                                                        <input type="text" name="author" id="author"
                                                               class="form-control validate" placeholder="Author" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <input type="text" name="description" id="description"
                                                               class="form-control validate" placeholder="Description"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="price">Price</label>
                                                        <input type="number" name="price" id="price"
                                                               class="form-control validate" placeholder="Price" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="book_cover">Book Cover</label>
                                                        <input type="file" accept="image/*" class="form-control-file border" name="book_cover" required>
                                                    </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" name="save_book" id="save_book" class="btn btn-default">
                                                    Save
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="" class="btn btn-success btn-rounded text-right" data-toggle="modal"
                                   data-target="#modalAddPayment">New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="data_table">
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Price</th>
                                <th>Cover</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach(fetch_all('books') as $book):?>
                            <tr>
                                <td><?= $book['category'] ?></td>
                                <td><?= $book['title'] ?></td>
                                <td><?= $book['author'] ?></td>
                                <td><?= $book['price'] ?></td>
                                <td><img src="<?= $book['book_cover'] ?>" alt="" width="50" height="70"></td>
                                <td>
                                    <div class="action_buttons_wrapper">
                                        <div class="action_button">
                                            <form action="update_book.php" method="post">
                                                <input type="hidden" name="update_id" value="<?= $book['id'] ?>">
                                                <button class="btn btn-success btn-sm" name="edit_book"><span class="icon-pencil"></span> Edit</button>
                                            </form>
                                        </div>
                                        <div class="action_button">
                                            <form action="./books.php" method="post">
                                                <input type="hidden" name="delete_id" value="<?= $book['id'] ?>">
                                                <button class="btn btn-danger btn-sm" name="delete_book"><span class="icon-trash"></span> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once "include/transform_data_table.php" ?>
</body>
</html>
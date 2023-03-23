<?php session_start()?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iNotes</title>
    <meta name="description" content="iNotes is an online todo app, it helps you to save your notes on the cloud for FREE">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <style>h3,h2,h4{margin-top: 50px}</style>
</head>

<body>
    <?php include 'header.php' ?>
    <main>
        <div class="container mt-5 mb-5">
            <h1 class="">Welcome to iNotes</h1>
            <p>Save your notes & task on the cloud!</p>
            <p>"Find your most productive self with our top picks for the best online todo lists. Stay organized and on task with ease. Try it now!"</p>

            <a href="login.php" class="btn btn-warning">Try for FREE</a>

            <div class="textdiv my-5">
                <h2>Get Organized with the Best Online Todo List</h2>
                <p><strong>iNotes</strong> is an online note taking & todo list app that can be used for multipurpose productivity works. It help you to increase your productivity day by day.
                </p>
                <h3>Online Todo Lists Apps</h3>
                <p>iNotes - Online todo lists are a great way to stay organized and on top of your responsibilities, especially in today's fast-paced, digital world. With the ability to access your list from anywhere, and the added convenience of being able to share it with others, online todo lists are quickly becoming a popular choice for both personal and professional use.</p>
                
                <h3>Streamline Your Task Management with the Best Task List Apps</h3>
                <p>Get a grip on your to-do list with the best task management apps. Find the perfect app for you and start tackling your tasks with ease.</p>
                <h2>iNotes - Benefits</h2>
                <p><strong>iNotes is an online todo lists web app, Below are the Benefits of using iNotes:</strong></p>
                <ol>
                    <li>
                        One of the biggest benefits of using an online todo list (iNotes) is the ability to access it from anywhere. Whether you're at home, at work, or on the go, you can easily log in to your list and see what tasks you need to complete. This is especially helpful for those who often work remotely or travel frequently.
                    </li>
                    <li>
                        Online todo lists also offer a wide range of features that can make managing your tasks even easier. Many apps include the ability to set reminders, schedule due dates, and even assign tasks to others. This makes it easy to stay on top of your responsibilities and collaborate with others, whether it's for work or personal use.
                    </li>
                    <li>
                        Another benefit of online todo lists is the ability to share your list with others. This can be especially helpful if you're working on a project with a team or if you want to share your list with a family member or friend. By sharing your list, others can see what tasks you need to complete, and can even help you to stay on track by reminding you of important deadlines.
                    </li>
                </ol>
                <h3>What we offer</h3>
                <p>Online todo lists also offer a range of customization options, so you can tailor your list to suit your specific needs. This can include the ability to add subtasks, set recurring tasks, and even categorize tasks into different lists. This level of customization allows you to create a list that is truly tailored to your needs, making it easy to stay organized and on top of your responsibilities</p>
                <h3>How to Create a Todo?</h3>
                <p>There are many different ways to create a todo list. Some people prefer to use a simple pen and paper, while others prefer to use digital tools such as apps or software. Some popular apps for creating todo lists include Todoist, Wunderlist, and Trello. These apps often come with features such as reminders, the ability to set due dates, and the ability to share your list with others.</p>
                <p>Creating a todo list can also be a great way to stay motivated and on track. Seeing the progress you've made on your list can be a powerful motivator, and can help you stay focused and productive even when you're feeling overwhelmed or demotivated.</p>

                <h2>Importance of Online TODO Apps</h2>
                <p>iNotes - online todo lists is a great way to stay organized and on top of your responsibilities. With the ability to access your list from anywhere, a wide range of features, and the ability to share your list with others, they are quickly becoming a popular choice for both personal and professional use. So, give it a try and see how it can help you stay on top of your tasks and reach your goals.</p>

                <h4>Popular Todo Apps</h4>
                <p>Some popular examples of online todo apps are Asana, Trello, Google Keep, Todoist, and Wunderlist. These apps are available for various platforms such as web, android and ios which makes it easy for the users to access it from anywhere.</p>
            </div>
        </div>


    </main>
    <?php include 'footer.php' ?>
    <script>
        $(document).ready(function() {

            $(".check").change(function() {
                if (this.checked) {
                    let id = $(this).attr("id");
                    setTimeout(function() {
                        location.href = `/inotes/check.php?id=${id}`;
                    }, 200);

                }
            });

            $(".uncheck").change(function() {
                if (!this.checked) {
                    let id = $(this).attr("id");
                    setTimeout(function() {
                        location.href = `/inotes/uncheck.php?id=${id}`;
                    }, 80);

                }
            });
        })
    </script>

</body>

</html>
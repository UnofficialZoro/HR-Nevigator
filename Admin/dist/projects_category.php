<?php
    $con = mysqli_connect('localhost', 'root', '', 'project');

    if(isset($_REQUEST['btnadd']))
    {
        $category=$_REQUEST['category'];

        $insert="INSERT INTO project_category (category) VALUES ('$category')";
        mysqli_query($con,$insert);
        header('location:projects.php');
    }

    // Handle delete operation
    if(isset($_REQUEST['delete']))
    {
        $id=$_REQUEST['delete'];
        $delete="DELETE FROM project_category where category_id='$id'";
        mysqli_query($con,$delete);
        header('location:projects_category.php');  
    }

    // Handle edit operation
    if (isset($_REQUEST['edit'])) {
        $id = $_REQUEST['edit'];
        $edit = "SELECT * FROM project_category WHERE category_id='$id'";  
        $edit_executed = mysqli_query($con, $edit);
        $edit_fetch = mysqli_fetch_array($edit_executed);

        // Update operation
        if(isset($_REQUEST['update'])) {
            $category = $_REQUEST['category']; // Corrected variable name
            $update = "UPDATE project_category SET category='$category' WHERE category_id='$id'";
            mysqli_query($con, $update);
            header("location:projects_category.php");
        }
    }

    // Fetch data for displaying in the table
    $data="SELECT * FROM project_category";
    $data1=mysqli_query($con,$data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>:: HR Navigator ::</title>
  <link rel="stylesheet" href="myProjects/webProject/icofont/css/icofont.min.css">
  
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input, select {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    
    button {
      background-color: purple;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    /* Added CSS for the table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .action-icons a {
      text-decoration: none;
      margin-right: 5px;
      color: purple;
    }

  </style>
</head>
<body>

  <div class="container">
    <h2>Add Projects Category</h2>
    <form method="post">
      <label for="projectName">Category Name:</label>
      <input type="text" name="category">
      <button type="submit" name="btnadd">Add Category</button>
    </form><br>

    <!-- Added table -->
    <table>
      <thead>
        <tr>
          <th>Category ID</th>
          <th>Category Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
        while($data2=mysqli_fetch_array($data1))
        {
      ?>
        <tr>
          <td><?php echo $data2['category_id'] ?> </td>
          <td><?php echo $data2['category'] ?> </td>
          <td>
            <a href="projects_category.php?edit=<?php echo $data2['category_id']; ?>" onclick="return confirm ('Are You Sure?')">Edit</a>
            <a href="projects_category.php?delete=<?php echo $data2['category_id']; ?>" onclick="return confirm ('Are You Sure?')">Delete</a>
          </td>
        </tr>
      <?php
        }
      ?>
      </tbody>
    </table>

    <!-- Edit form -->
    <?php if(isset($_REQUEST['edit'])) { ?>
        <h2>Edit Category</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $edit_fetch['category_id']; ?>">
            <label for="category">Category Name:</label>
            <input type="text" name="category" value="<?php echo $edit_fetch['category']; ?>">
            <button type="submit" name="update">Update Category</button>
        </form>
    <?php } ?>
  </div>

</body>
</html>

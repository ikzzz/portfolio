<title><?=$title?></title>
<body>
<div id="container">
    </div>
    <div class="content">
        <h1><?=$title?></h1>


<table border="1">
     <th>Имя</th><th>E-mail</th>
<? 
     foreach ($users as $user): ?>
       <tr>
            <td> <div class="shopUnitName">
                <?php echo $user['name']; ?>
         </div></td><td>     
            <div class="shopUnitShortDesc">
                <?php echo $user['email']; ?>
           </div></td></td>
        <?php endforeach; ?>

</table>
</div>
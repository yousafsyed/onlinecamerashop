<html>
<head>
        <title>categorie</title>
        <meta charset="UTF-8">


</head>
<body>

    <table>
        <thead>
            <th>c_id</th>
            
            <th>c_name</th>
            
            <th>C_description</th>
            
            c_id,c_name,C_description
        
        </thead>
    <tbody>
            <tr>
                <td> <?php echo $categgorie->c_id; ?></td>
                <td> <?php echo $categgorie->c_name; ?></td>
                <td> <?php echo $categgorie->C_description; ?></td>
            
            </tr>
            
          <?php  endforeach($categgorie as $categgorie ); ?>        
            <tr>
            
                <td><?php echo $categgorie->c_id; ?></td>
                <td><?php echo $categgorie->c_name; ?></td>
                <td><?php echo $categgorie->C_description; ?></td>
            
                
                
            
            
            </tr>
    
    
    </tbody>
    
    
    </table>

    

</body>
</html>

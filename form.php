
  <?php
 $dns='mysql:host=localhost;dbname=hana';
$username='root';
$password='';

$con=new PDO("mysql:host=localhost;dbname=hana","$username","$password");
     $message='';
   $animaux='';
   $DateTime='';
   $note='';
   $veterinaire='';
   $transport='';
   $PrixTrans='';
   
   
   function getPosts(){
		 
        $posts=array();	
         		
		$posts[0]=$_POST['animaux'];
		$posts[1]=$_POST['date'];
		$posts[2]=$_POST['note'];
        $posts[3]=$_POST['veterinaire'];
		$posts[4]=$_POST['transport'];
		$posts[5]=$_POST['PrixTrans'];
		
		return $posts;
	   }
       
	 if(isset($_POST['signup'])){
		 
		 
		 $data=getPosts();
		$insert=$con->prepare("INSERT INTO vaccine
         (animaux, date, note, veterinaire, transport,PrixTrans)
    VALUES(:animaux, :date, 
         :note, :veterinaire, :transport,:PrixTrans)");
  $statement = $connection->prepare($sql);
  if ($statement->execute([':animaux' => $animaux,
                     ':date' => $DateTime, ':note' => $note,
                       ':veterinaire' => $veterinaire, 
                     ':transport' => $transport ,
                     ':PrixTrans' =>$PrixTrans]));
					
			   if($insert){
				   
				 
				
			 }
			}
  ?>
 
 <?php
   require_once("fpdf.php");
   $pdf=new FPDF();
   $pdf->AddPage();
   
  
   
     $pdf->SetFont("arial","B",14);
   
$pdf->image("pp.jpg",50,0,80,"jpg");
  
   $pdf->Cell(0,70,"N:....                                                                                      Khenifra le :{$date}",0);

   $pdf->Write(40,"                               Je soussigne,le chef de Service:{$nom_service}  ");
   $pdf->Write(20,"                                                                           ONEP Khenifra  ");
   $pdf->Write(20,"
                                                  ATTESTE QUE:");
											
   $pdf->Write(14," 
         {$nomuser} a passe un stage de formation  au service :{$nom_service} au sein d'office National de l'eau Potable Khenifra ,et ce durant la periode allant:");
 $pdf->Write(12,"
                                                  Du: {$debut}
					                                            Au: {$fin} ");	
							   
   	
    $pdf->Write(14,"
	       La presente attestation est delivree a l'interessee sur sa demande pour servir et valoir ce que de droit.");
   
    $pdf->Write(12,"
	                                                                                

                                 																				                                        Signature.....");
   
     $pdf-> Output(); 
  
	 
 
 ?>
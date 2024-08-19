<?php 
session_start();
include '../config/db.php';
$oke = mysqli_query($con,"select * from tb_sekolah where id_sekolah='1'");
$oke1 = mysqli_fetch_array($oke);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>E-Learning</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="shortcut icon" type="image/png" href="../vendor/images/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="../vendor/login/css/main.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="../vendor/node_modules/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendor/node_modules/simple-line-icons/css/simple-line-icons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../vendor/css/style.css">
  <!-- endinject -->
   <link href="../vendor/sweetalert/sweetalert.css" rel="stylesheet" />
</head>
<body style="background-image:url(../vendor/images/bhg.jpg);jpg);background-size:cover;">
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../vendor/login/images/bg.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
			 <center><img src="../vendor/images/favicon.png" alt="" height="100" width="100"></center><br>
				<form method="post" action="" class="login100-form validate-form">
					<span class="login100-form-title p-b-49">
						E-LEARNING AMYEDU
					</span>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">User</span>
						<video style="height: 18rem;border-radius: 16px;" onloadedmetadata="onPlay(this)" id="inputVideo" autoplay muted playsinline></video>
					</div>

					<div class="container-login100-form-btn m-b-23">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button value="capture" name="capture" type="submit" class="login100-form-btn">Capture</button>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
              <a href="../index.php" class="login100-form-btn" style="text-decoration:none;">Back to login</a>
						</div>
					</div>
				</form>
				<?php
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'localhost:7002/coco',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_POSTFIELDS => array('user_id' => '123','name' => 'arman nugraha'),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        var_dump($response);
        
  if($_SERVER['REQUEST_METHOD']=='POST'){
   $email = trim(mysqli_real_escape_string($con, $_POST['username']));
   $pass = sha1($_POST['password']); 
   $level = $_POST['level'];

  if ($level =='1') {
      $sql = mysqli_query($con,"SELECT * FROM tb_guru WHERE email='$email' AND password='$pass' AND status='Y' ") or die(mysqli_error($con)) ;
      $data = mysqli_fetch_array($sql);
      $id = $data [0];
      $cek = mysqli_num_rows($sql);

      if ($cek >0 ){
      $_SESSION['Guru'] = $id;
      $_SESSION['upload_gambar']= TRUE;
      
              echo "
              <script type='text/javascript'>
              setTimeout(function () {
              swal({
             title: 'Sukses',
              text:  'Login Berhasil..',
              type: 'success',
              timer: 3000,
              showConfirmButton: true
              });     
              },10);  
              window.setTimeout(function(){ 
              window.location.replace('Guru/index.php');
              } ,3000);   
              </script>";
             
      }else{
          echo "
          <script type='text/javascript'>
          setTimeout(function () {
          swal({
          title: 'Error',
           text:  'User ID / Password Salah Atau Belum Dikonfirmasi Oleh Admin !',
          type: 'error',
          timer: 3000,
          showConfirmButton: true
          });     
          },10);  
          window.setTimeout(function(){ 
          window.location.replace('?pages=login');
          } ,3000);   
          </script>";


      }

  } elseif ($level =='2') { 
    $sql = mysqli_query($con,"SELECT * FROM tb_siswa WHERE nis='$email' AND password='$pass' AND aktif='Y' ") or die(mysqli_error($con)) ;
      $data = mysqli_fetch_array($sql);
      $id = $data [0];
      $cek = mysqli_num_rows($sql);

      if ($cek >0 ){

      $_SESSION['Siswa'] = $id;
      $_SESSION['username']     = $data['nis'];
      $_SESSION['namalengkap']  = $data['nama_siswa'];
      $_SESSION['password']     = $data['password'];
      $_SESSION['nis']          = $data['nis'];
      $_SESSION['id_siswa']          = $data['id_siswa'];
      $_SESSION['kelas']        = $data['id_kelas'];
      $_SESSION['jurusan']        = $data['id_jurusan'];
       $_SESSION['tingkat']        = $data['tingkat'];
      mysqli_query($con,"UPDATE tb_siswa SET status='Online' WHERE id_siswa='$data[id_siswa]'");
             echo "
              <script type='text/javascript'>
              setTimeout(function () {
              swal({
              title: 'Sukses',
              text:  'Login Berhasil..',
              type: 'success',
              timer: 3000,
              showConfirmButton: true
              });     
              },10);  
              window.setTimeout(function(){ 
              window.location.replace('Siswa/index.php');
              } ,3000);   
              </script>";           
      }else{
               echo "
          <script type='text/javascript'>
          setTimeout(function () {
          swal({
          title: 'MAAF !',
          text:  'User ID / Password Salah Atau Belum Dikonfirmasi Oleh Admin !',
          type: 'error',
          timer: 3000,
          showConfirmButton: true
          });     
          },10);  
          window.setTimeout(function(){ 
          window.location.replace('?pages=login');
          } ,3000);   
          </script>";


      }



}elseif ($level =='3') {
  $sql = mysqli_query($con,"SELECT * FROM tb_admin WHERE username='$email' AND password='$pass' AND aktif='Y' ") or die(mysqli_error($con)) ;
  $data = mysqli_fetch_array($sql);
  $id = $data [0];
  $cek = mysqli_num_rows($sql);

  if ($cek >0 ){
  $_SESSION['Admin'] = $id;
  $_SESSION['upload_gambar']= TRUE;
  
          echo "
          <script type='text/javascript'>
          setTimeout(function () {
          swal({
          title: 'Admin',
          text:  'Login Berhasil..',
          type: 'success',
          timer: 3000,
          showConfirmButton: true
          });     
          },10);  
          window.setTimeout(function(){ 
          window.location.replace('Admin/index.php');
          } ,3000);   
          </script>";
         
  }else{
      echo "
      <script type='text/javascript'>
      setTimeout(function () {
      swal({
      title: 'Gagal',
       text:  'User ID / Password Salah Atau Belum Dikonfirmasi Oleh Admin !',
      type: 'error',
      timer: 3000,
      showConfirmButton: true
      });     
      },10);  
      window.setTimeout(function(){ 
      window.location.replace('?pages=login');
      } ,3000);   
      </script>";


  }
}

}
?>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="../vendor/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/login/vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="../vendor/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/login/js/main.js"></script>
	<script src="../vendor/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="../vendor/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="../vendor/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="../vendor/sweetalert/sweetalert.min.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../vendor/js/off-canvas.js"></script>
  <script src="../vendor/js/misc.js"></script>

  <script type="text/javascript">
    let forwardTimes = []
    let video = document.querySelector("#inputVideo");
    // let click_button = document.querySelector("#clicks-photo");
    let canvas = document.querySelector("#canvas");

    // click_button.addEventListener('click', function() {
    //     canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
    //     let image_data_url = canvas.toDataURL('image/jpeg');

    //     // data url of the image
    //     // console.log(image_data_url);
    //     // $("#pic1").attr("src", image_data_url);
        
    // });

    async function capt() {
      canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
      let image_data_url = canvas.toDataURL('image/png');

      // data url of the image
      // console.log(image_data_url);
      // $("#pic1").attr("src", image_data_url);
      //Usage example:
      urltoFile(image_data_url, 'capture.png','image/png')
      .then(async function(file){
        // const imgFile = file.get(0).files[0]
        const input = await faceapi.bufferToImage(file)
        // console.log(img);

        const ts = Date.now()
        const descriptor = await faceapi.computeFaceDescriptor(input)
        displayTimeStats(Date.now() - ts)

        const bestMatch = faceMatcher.findBestMatch(descriptor)
        $('#prediction').val(bestMatch.toString())
        // console.log(descriptor,bestMatch)
        console.log(bestMatch.toString())

        currImageIdx = currClassIdx === (classes.length - 1)
          ? currImageIdx + 1
          : currImageIdx
        currClassIdx = (currClassIdx + 1) % classes.length

        currImageIdx = (currImageIdx % 6) || 2
      });
    }
    function urltoFile(url, filename, mimeType){
        return (fetch(url)
            .then(function(res){return res.arrayBuffer();})
            .then(function(buf){return new File([buf], filename,{type:mimeType});})
        );
    }

    async function run() {
      try {
        console.log('loading model file...')

        // await faceapi.loadFaceRecognitionModel('/')

        console.log('computing initial descriptors...')

        // faceMatcher = await createBbtFaceMatcher(1)
        // $('#loader').hide()

        // runFaceRecognition()

        // load face detection model
        // await changeFaceDetector(TINY_FACE_DETECTOR)
        // changeInputSize(128)

        // try to access users webcam and stream the images
        // to the video element
        const stream = await navigator.mediaDevices.getUserMedia({ video: {} })
        const videoEl = $('#inputVideo').get(0)
        videoEl.srcObject = stream
      } catch (err) {
        console.error(err)
      }
    }
   async function onPlay() {
      const videoEl = $('#inputVideo').get(0)
      if(videoEl.paused || videoEl.ended || !isFaceDetectionModelLoaded())
        return setTimeout(() => onPlay())
      const options = getFaceDetectorOptions()
      const ts = Date.now()
      const result = await faceapi.detectSingleFace(videoEl, options)

      updateTimeStats(Date.now() - ts)

      if (result) {
        const canvas = $('#overlay').get(0)
        const dims = faceapi.matchDimensions(canvas, videoEl, true)
        faceapi.draw.drawDetections(canvas, faceapi.resizeResults(result, dims))
      }

      setTimeout(() => onPlay())
    }
    $(document).ready(function() {
      run()
      fetch('https://node-nikreuh.herokuapp.com/', {mode: 'no-cors'})
      .then(res => console.log(res))
    }) 
  </script>

</body>
</html>
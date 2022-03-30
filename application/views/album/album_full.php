<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Album</title>


  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="<?=base_url('assets/css/normalize.min.css')?>">
  <link rel="stylesheet" href="<?=base_url('assets/css/paper.css')?>">
	<script src="<?=base_url('assets/js/jquery-3.4.1.min.js')?>"></script>
	<script src="<?=base_url('assets/js/html2canvas.js')?>"></script>
	<script src="<?=base_url('assets/js/jspdf.debug.js')?>"></script>
  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A3 portrait }</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A3 portrait">
	<?php 
	foreach($entries as $halaman){ 
		$this->view("album/halaman_album", $halaman);
	}
	
	?>
	<script>
	function printPDF(){
		let pdf = new jsPDF('p','pt','a3');

        var pdfName = 'album.pdf';

        var options = {};

        var $divs = $('section')                //jQuery object of all the myDivClass divs
        var numRecursionsNeeded = $divs.length -1;     //the number of times we need to call addHtml (once per div)
        var currentRecursion=0;

        //Found a trick for using addHtml more than once per pdf. Call addHtml in the callback function of addHtml recursively.
        function recursiveAddHtmlAndSave(currentRecursion, totalRecursions){
            //Once we have done all the divs save the pdf
            if(currentRecursion==totalRecursions){
                pdf.save(pdfName);
            }else{
                currentRecursion++;
                pdf.addPage();
                //$('.myDivClass')[currentRecursion] selects one of the divs out of the jquery collection as a html element
                //addHtml requires an html element. Not a string like fromHtml.
                pdf.addHTML($('section')[currentRecursion], options, function(){
                    console.log(currentRecursion);
                    recursiveAddHtmlAndSave(currentRecursion, totalRecursions)
                });
            }
        }

        pdf.addHTML($('section')[currentRecursion], options, function(){
            recursiveAddHtmlAndSave(currentRecursion, numRecursionsNeeded);
        });
	}
	$(window).on("load", function() {
	});
	$(function(){
	});
	</script>
</body>

</html>

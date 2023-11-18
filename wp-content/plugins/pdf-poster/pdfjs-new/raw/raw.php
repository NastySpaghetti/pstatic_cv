<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Render Multi-page PDF in Canvas using PDFJS</title>
  <link rel="stylesheet" href="style.css">
  <script src="pdfjs.min.js" type="text/javascript"></script>

<style type="text/css">




</style>
</head>
<body>
<!-- partial:index.partial.html -->
<div style="pointer-events:none" id="holder"></div>
<!-- partial -->
<script>





function renderPDF(url, canvasContainer, options) {

    options = options || { scale: 1.2 };
        
    function renderPage(page) {
        var viewport = page.getViewport(options.scale);
        var wrapper = document.createElement("div");
        wrapper.className = "canvas-wrapper";
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        var renderContext = {
          canvasContext: ctx,
          viewport: viewport
        };
        
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        wrapper.appendChild(canvas)
        canvasContainer.appendChild(wrapper);
        
        page.render(renderContext);
    }
    
    function renderPages(pdfDoc) {
        for(var num = 1; num <= pdfDoc.numPages; num++)
            pdfDoc.getPage(num).then(renderPage);
    }

    PDFJS.disableWorker = true;
    PDFJS.getDocument(url).then(renderPages);

}   


renderPDF('<?php echo $_GET["file"]; ?>', document.getElementById('holder'));



</script>

</body>
</html>

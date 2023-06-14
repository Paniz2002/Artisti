<!DOCTYPE html>
<html>
    <head>
    <title>Artisti</title>
        <link rel="shortcut icon" href="extra/logo_white_largo.png" type="image/png">
        <link rel="icon" href="extra/logo_white_largo.png" sizes="32x32" type="image/png">
        <link rel="apple-touch-icon-precomposed" href="extra/logo_white_largo.png" type="image/png" sizes="152x152">
        <link rel="apple-touch-icon-precomposed" href="extra/logo_white_largo.png" type="image/png" sizes="120x120">
        <link rel="icon" href="extra/logo_white_largo.png" sizes="96x96" type="image/png">
        <meta charset="UTF-8">
        <title></title>
        <script>
            var TxtRotate = function(el, toRotate, period) {
            this.toRotate = toRotate;
            this.el = el;
            this.loopNum = 0;
            this.period = parseInt(period, 10) || 2000;
            this.txt = '';
            this.tick();
            this.isDeleting = false;
            };

            TxtRotate.prototype.tick = function() {
            var i = this.loopNum % this.toRotate.length;
            var fullTxt = this.toRotate[i];

            if (this.isDeleting) {
                this.txt = fullTxt.substring(0, this.txt.length - 1);
            } else {
                this.txt = fullTxt.substring(0, this.txt.length + 1);
            }

            this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

            var that = this;
            var delta = 300 - Math.random() * 100;

            if (this.isDeleting) { delta /= 2; }

            if (!this.isDeleting && this.txt === fullTxt) {
                delta = this.period;
                this.isDeleting = true;
            } else if (this.isDeleting && this.txt === '') {
                this.isDeleting = false;
                this.loopNum++;
                delta = 500;
            }

            setTimeout(function() {
                that.tick();
            }, delta);
            };

            window.onload = function() {
            var elements = document.getElementsByClassName('txt-rotate');
            for (var i=0; i<elements.length; i++) {
                var toRotate = elements[i].getAttribute('data-rotate');
                var period = elements[i].getAttribute('data-period');
                if (toRotate) {
                new TxtRotate(elements[i], JSON.parse(toRotate), period);
                }
            }
            // INJECT CSS
            var css = document.createElement("style");
            css.type = "text/css";
            css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid #666 }";
            document.body.appendChild(css);
            };
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="introduction.css">
    </head>
    <body>
    <br>
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,100,400" rel="stylesheet" type="text/css" />
        <div style="text-align:center">
        <img style="width:120px;height:120px;" src="extra/logo_white_largo2.png" alt="logo">
        </div>
    <h1>
    <span
        class="txt-rotate"
        data-period="2000"
        data-rotate='[ "Artisti"]'></span>
    </h1>
    <form action="registrazione.php">
    <button class="btn  btn-primary" type="submit" >Registrati o effettua il login</button>
    </form>
    </body>
</html>

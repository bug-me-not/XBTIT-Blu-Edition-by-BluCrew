var newwindow;function popdetails(url){newwindow=window.open(url,'popdetails','height=500,width=500,resizable=yes,scrollbars=yes,status=yes');if(window.focus)newwindow.focus();}
function poppeer(url){newwindow=window.open(url,'poppeers','height=400,width=650,resizable=yes,scrollbars=yes');if(window.focus)newwindow.focus();}
function PopRadio(form){newWin=window.open('play.php?type='+form,'Radio','height=100,width=400,resizable=yes,scrollbars=yes');if(window.focus){newWindow.focus()}}
function resize(img){if(img.width>500){img.height=parseInt(img.height*500/img.width);img.width=500;img.title='Click on image for full size view.';var foo=document.getElementById(img.name);foo.innerHTML='<strong>Click on image for full size view.</strong><br /><a href="'+img.src+'" target="_blank">'+foo.innerHTML+'</a>';}}
function resize_avatar(img){if(img.width>80){img.height=parseInt(img.height*80/img.width);img.width=80;}}
function ProcessIMG(str){newWin=window.open('./googly/process.php?image='+str,'Google Image Ripper','height=300,width=400,resizable=yes,scrollbars=yes,left=350,top=250');if(window.focus){newWindow.focus()}}
function resize_sig(img){if(img.width>470){img.height=170;img.width=470;}}
function announce(url){newwindow=window.open(url,'Announcements','height=400,width=650,resizable=yes,scrollbars=yes');if(window.focus)newwindow.focus();}
function popprogress(url){newwindow=window.open(url,'progress','height=100,width=200,resizable=no,scrollbars=no,status=no,left=400,top=300');if(window.focus)newwindow.focus();}
      	function gallery(url) {
        newwindow=window.open(url,'Gallery','height=400,width=650,resizable=yes,scrollbars=yes');
        if (window.focus) newwindow.focus();
    }
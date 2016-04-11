  function moveDown(optionId)
  {
    var el = document.getElementById('option' + optionId);
    if(el.nextSibling){
      var nextObj = el.nextSibling;
      var inputsNext = nextObj.getElementsByTagName('input');
      
      var nextOrder = false;
      for(var no=0;no<inputsNext.length;no++){
        if(inputsNext[no].id.indexOf('existing_pollOrder')>=0)nextOrder = inputsNext[no];  
      }
      var inputsThis = el.getElementsByTagName('input');
      var thisOrder = false;
      for(var no=0;no<inputsThis.length;no++){
        if(inputsThis[no].id.indexOf('existing_pollOrder')>=0)thisOrder = inputsThis[no];  
      }      
      var tmpValue = nextOrder.value;
      nextOrder.value = thisOrder.value;
      thisOrder.value = tmpValue;
      el.parentNode.insertBefore(el.nextSibling,el);
    }
    
  }
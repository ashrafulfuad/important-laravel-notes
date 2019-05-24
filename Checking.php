function sliderinsert()
    {
        print_r($_POST);                    // checking all form data after submitting in PHP
        echo $_POST['product_name'];      // checking form data after submitting in PHP specific array
    }


function sliderinsert(Request $request)
    {
      print_r($request->all());             // checking all form data after submitting in Laravel
      echo $request->product_name;        // checking form data after submitting in Laravel specific array
    }
    
    
    

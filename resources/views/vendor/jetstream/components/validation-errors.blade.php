
 @if ($errors->any())
    <div {{ $attributes }}>
  
     

            @foreach ($errors->all() as $error)

                @if($error  == "The email has already been taken.")

            
              
                    <div class="font-medium text-red-600">{{ __('The email has already been taken') }}</div>
                @elseif( $error  == "The password confirmation does not match.")

                <div class="font-medium text-red-600">{{ __('The password confirmation does not match') }}</div>

                @elseif( $error  == "The password must be at least 8 characters.")
                <div class="font-medium text-red-600">{{ __('The password must be at least 8 characters') }}</div>

                @else
                <div class="font-medium text-red-600">{{ __('Email or Password is incorrect') }}</div>
                @endif
          
            @endforeach
        
       
    </div>
    @endif
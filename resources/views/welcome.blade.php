<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>App Store</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
           
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
*{
    margin: 0;
    padding: 0;
    transition: all 0.5s;
    font-family: "Poppins", sans-serif;
}
body{
 
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #404658;
}
img{
    width: 32px;
}
.mainContainer{
    position: relative;
}
.mainContainer .circle{
    position: absolute;
    box-shadow: 10px 10px 30px rgb(0 0 0 /46%);
    border-radius: 50%;
    background: #4c4b58;
}
.mainContainer .circle:nth-child(1){
    width: 100px;
    height: 100px;
    top: -15px;
    right: -45px;
}
.mainContainer .circle:nth-child(2){
    width: 130px;
    height: 130px;
    top: 105px;
    left: -105px;
    z-index: 2;
}
.mainContainer .circle:nth-child(3){
    width: 60px;
    height: 60px;
    bottom: 85px;
    right: -30px;
    z-index: 2;
}
.mainContainer .circle:nth-child(4){
    width: 70px;
    height: 70px;
    bottom: 35px;
    left: -30px;
    z-index: 2;
}
.mainContainer .circle:nth-child(5){
    width: 50px;
    height: 50px;
    top: -15px;
    left: -27px;
}
.mainContainer .circle:nth-child(6){
    width: 85px;
    height: 85px;
    top: 165px;
    right: -107px;
}
.container{
    position: relative;
    padding: 50px;
    width: 370px;
    min-height: 380px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
    border-radius: 20px;
    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
}
.container::after{
    content: '';
    position: absolute;
    top: 5px;
    right: 5px;
    bottom: 5px;
    left: 5px;
    border-radius: 20px;
    pointer-events: none;
    background: linear-gradient(to bottom, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.1) 2%);
}
.form h1{
    letter-spacing: 2px;
    margin: 0px 0px 40px 10px;
}
.form .inputBx{
    position: relative;
    width: 100%;
    margin-bottom: 30px;
}
.form .inputBx input{
    width: 100%;
    outline: none;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background: rgba(255, 255, 255, 0.2);
    padding: 8px 10px 8x 40px;
    border-radius: 22px;
    font-size: 16px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}
.form .inputBx img{
    position: absolute;
    top: -3px;
    left: 2px;
    transform: scale(0.4);
    filter: invert(1);
}
.form .inputBx input[type=submit]{
    background: #fff;
    color: #111;
    max-width: 100px;
    padding: 15px 18px;
    letter-spacing: 1px;
    cursor: pointer;
    outline: none;
    border: 0.3px solid rgba(255, 255, 255, 0.582);
}
.form .inputBx input[type=submit]:hover{
    background: linear-gradient(115deg, rgba(0, 0, 0, 0.1), rgba(255, 255, 255, 0.25));
    color: #fff;
}
.form .inputBx span{
    position: absolute;
    left: 30px;
    display: inline-block;
    pointer-events: none;
}
.form .inputBx input:focus ~ span,
.form .inputBx input:valid ~ span{
    transform: translateX(-30px) translateY(-33px);
    font-size: 12px;
}
.form p{
    font-size: 13px;
    margin-top: 5px;
}
.form p a{
    color: #fff;
    font-size: 12px;
}
.form p a:hover{
    color: #000000;
}
.a{

    padding: 5px;
    margin-bottom: 3px;
}
.b{
    padding: 5px;

} 
span{
    color: white;
}
.circle:hover{
background-color: white;
}
        </style>
    </head>
    <body class="antialiased">
      
        <div class="mainContainer">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="container">
                <div class="form">
                    <h1>LOGIN</h1>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf                        <div class="inputBx">
                            <input type="email" class='a' name="email" :value="old('email')" required autofocus>
                            <span>Email</span>
                            
                        </div>
                        <div class="inputBx">
                            <input type="password" class='a' name="password" type="password"
                            name="password"
                            required  autocomplete="current-password" autofocus>
                            <span>Password</span>
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        </div>
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                        <div class="inputBx">
                            <input type="submit" value="login">
                        </div>
                    </form>
                    
                        @if (Route::has('password.request'))
                    <p>Forgot password?  <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a></p> @endif
                </div>
            </div>
        </div>

       

       
      

       
    </body>
</html>

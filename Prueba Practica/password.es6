const Password=document.querySelector("#Password");
const passwordButton=document.querySelector("#passwordButton");
const passwordIcon=document.querySelector("#passwordIcon");

const togglePassword=e=>{
    const {length:passwordLength}=Password.value;
    e.stopPropagation();


    if(passwordIcon.innerText==="visibility"){
    passwordIcon.innerText="visibility_off";
    Password.type="text";
    }else{
        passwordIcon.innerText="visibility";
        Password.type="password";
    }
    if(passwordLength){
    Password.focus();
    input.setSelectionRange(passwordLength,passwordLength);
    }
};
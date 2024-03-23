const showPass = () => {

    var x = document.getElementById("pass");
    var y = document.getElementById("eye");
    var z = document.getElementById("eye_slash");

    if(x.type === 'password')
    {
        x.type = "text";
        y.style.display = "none";
        z.style.display = "block"
    }
    else
    {
        x.type = "password";
        y.style.display = "block";
        z.style.display = "none"
    }
}
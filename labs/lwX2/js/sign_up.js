function complainEmails()
{
    var email = document.getElementById('email').value;
    var re_email = document.getElementById('re_email').value;
    return (email === re_email);
}

function showErrMsg()
{
    var errBoxDisplay = 'block';
    var errBox = document.getElementById('divergent_email');
    errBox.style.display = errBoxDisplay;
}

function submitHandler()
{
    if (this.status && complainEmails())
    {
        this.submit();
    }
    else if (this.status)
    {
        showErrMsg();
    }
    return false;
}

function onloadHandler()
{
    var fields =
    {
        'email': 'email',
        're_email': 'email',
        'first_name': 'text',
        'last_name': 'text',
        'password': 'pass'
    };

    var val = new ValidateForm(fields);

    var form = document.getElementById('reg_form');
    form.__proto__ = val;
    form.onsubmit = submitHandler;
}

window.onload = onloadHandler;
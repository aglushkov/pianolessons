$(function(){
    Contact = new Contacts();
    Contact.onSubmit();
    Contact.onElemClick();
});

var Contacts = function()
{
    this.form = $("#contact");
    this.nameElem = $("#username");
    this.emailElem = $("#useremail");
    this.phoneElem = $("#userphone");
    this.messageElem = $("#usermessage");
    
    this.init = function()
    {
        this.name = this.trim(this.nameElem.val());
        this.email = this.trim(this.emailElem.val());
        this.phone = this.trim(this.phoneElem.val());
        this.message = this.trim(this.messageElem.val());
        this.alertMessages = new Array();
        this.wrongElems = new Array();
    }
    
    this.checkForm = function()
    {
        this.init();
        
        if (this.name=="")
        {
            this.alertMessages.push("Please enter your name");
            this.wrongElems.push(this.nameElem);
        }
        if (this.email=="")
        {
            this.alertMessages.push("Please enter your email");
            this.wrongElems.push(this.emailElem);
        }
        if (this.phone=="")
        {
            this.alertMessages.push("Please enter your phone");
            this.wrongElems.push(this.phoneElem);
        }
        if (this.message=="")
        {
            this.alertMessages.push("Please enter your message");
            this.wrongElems.push(this.messageElem);
        }
        
        var result = this.alertMessages.length==0?true:false;
        
        return result;
    }
    
    this.onSubmit = function()
    {
        this.form.submit(function(){
            var result = Contact.checkForm();
            if(!result)
            {
                alert(Contact.alertMessages.join("\n"))
                $.each(Contact.wrongElems,function(){
                    this.css("background-color","red");
                })
            }    
            return result;
        })
    }
    this.onElemClick = function()
    {
        this.nameElem.add(this.emailElem).add(this.phoneElem)
        .add(this.messageElem).click(function(){
            $(this).css("background-color","white");
        })
    }
    
    this.trim = function(string)
    {
         return string.replace(/(^\s+)|(\s+$)/g, "");
    }
}





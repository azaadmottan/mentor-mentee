let messageBox = $("#messageBox");

let selectfile = `<img src='../images/cancel.png'> Error ! Please choose profile picture.`;
let reloadPage = `<img src='../images/alert.png'> Alert ! Please reload page to update profile.`;
let errorFileUpload = `<img src='../images/cancel.png'> Error ! Failed to upload file.`;
let successFileUploaded = `<img src='../images/check.png'> Success ! File Uploaded Successfully.`;

let successAddUser = `<img src='../images/check.png'> Success ! Add User Successfully.`;
let successDeleteUser = `<img src='../images/check.png'> Success ! Delete User Successfully.`;

let errorField = `<img src='../images/cancel.png'> Error ! All fields are required.`;
let errorUserExist = `<img src='../images/cancel.png'> Error ! User already Exist.`;
let errorDeleteUser = `<img src='../images/cancel.png'> Error ! Failed to Remove User.`;
let errorDelete = `<img src='../images/cancel.png'> Error ! Something went wrong.`;


const message = (msg) => {
    let toast = $("<div></div>").addClass("toast bg-dark-subtle").html(msg);
    messageBox.append(toast);

    setTimeout(() => {
        toast.remove();
    }, 5000);
};

// export { message };

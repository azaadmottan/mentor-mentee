let messageBox = $("#messageBox");

const message = (type, message) => {
    
    let toastMsg = `<img src='../images/check.png'> Error !`;

    if (type === "success") {
        toastMsg = `<img src='../images/check.png'> ${message}`;
    }
    else if (type === "alert") {
        toastMsg = `<img src='../images/alert.png'> ${message}`;
    }
    else if (type === "error") {
        toastMsg = `<img src='../images/cancel.png'> ${message}`;
    }

    let toast = $("<div></div>").addClass("toastMsg bg-body-secondary p-").html(toastMsg);
    messageBox.append(toast);

    let toastTimeout = setTimeout(() => {
        toast.remove();
    }, 5000);

    toast.on('mouseover', function() {
        clearTimeout(toastTimeout);
        $(this).addClass('paused');
    });

    toast.on('mouseout', function() {
        $(this).addClass('running');
        toastTimeout = setTimeout(() => {
            toast.remove();
        }, 5000 - (Date.now() - startTime));
    });

    let startTime = Date.now();
};
function showAlert(title, information, color, custom_icon = ""){
    let cor = ['red','green','orange','blue','purple','dark']; // 0 - 5
    let icons = "";
    switch (cor[color]) {
        case 'red':
            icons = "fa-solid fa-bug";
            break;
        case 'green':
            icons = "fa-solid fa-circle-check";
            break;
        case 'orange':
            icons = "fa-solid fa-triangle-exclamation"
            break;
        case 'blue':
            icons = "fa-solid fa-circle-info"
            break;
        case 'purple':
            icons = "fa-solid fa-circle-radiation";
            break;
        case 'dark':
            icons = "fa-brands fa-ubuntu";
            break;

        default:
            break;
    }

    if(custom_icon){
        icons = custom_icon;
    }
    $.confirm({
        title: title,
        icon: icons,
        content: information,
        type: cor[color],
        typeAnimated: true,
        buttons: {
            OK: {
                text: 'OK',
                btnClass: 'btn-'+cor[color],
                action: function(){
                }
            },
        }
    });
}
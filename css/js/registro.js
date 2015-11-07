
$("#avatar").fileinput({
    overwriteInitial: true,
    maxFileSize: 1500,
    showClose: false,
    showCaption: false,
    browseLabel: '',
    removeLabel: '',
    browseIcon: '<span class="glyphicon glyphicon-folder-open"></span>',
    removeIcon: '<span class="glyphicon glyphicon-remove"></span>',
    removeTitle: 'Cancel or reset changes',
    elErrorContainer: '#kv-avatar-errors',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="../img/default_avatar_male.jpg" alt="Your Avatar" style="width:160px">',
    layoutTemplates: {main2: '{preview} {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "gif"]
});
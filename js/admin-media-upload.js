function init_custom_media(name, title){
  let frame;
  const addImgLink = $(`#${name}_media_add`);
  const delImgLink = $(`#${name}_media_remove`);
  const imgContainer = $(`#${name}-wrapper`);
  const imgIdInput = $(`#${name}-id`);
  const options = {
    title: `Выберите ${title}`,
    button: { text: 'Выбрать' },
    multiple: false,
  };
  
  addImgLink.on( 'click', function( event ){
    event.preventDefault();
    if (frame) {
      frame.open();
      return;
    }
    frame = wp.media(options);
    frame.on('select', () => {
      const attachment = frame.state().get('selection').first().toJSON();
      imgContainer.html('<img src="'+attachment.url+'" alt="" style="max-height:100px;"/>');
      imgIdInput.val(attachment.id);
    });
    frame.open();
  });
  
  delImgLink.on('click', (e) => {
    e.preventDefault();
    imgContainer.html( '' );
    imgIdInput.val( '' );
  });
};
ymaps && ymaps.ready(() => {
  [...document.getElementsByClassName('ymap-block')].forEach(el => {
    const points = el.getAttribute('point');
    const balloon = el.getElementsByClassName('baloon')[0];
    const submenu = el.getElementsByClassName('list-group');

    if(submenu.length){
      submenu[0].classList.remove('d-none');
    }


    if(!points) return;
    el.style.height = '350px';

    const state = {
      center: JSON.parse(el.getAttribute('center')),
      zoom: el.getAttribute('zoom'),
      controls: [],
    }

    let collection = new ymaps.GeoObjectCollection();
    // let map = new ymaps.Map(el, state, {suppressMapOpenBlock: true});
    let map = new ymaps.Map(el, state);


    const locations = JSON.parse(`[${points}]`);
    locations.forEach(location => collection.add(new ymaps.Placemark(location,
      {
        balloonContentHeader: balloon ? balloon.getAttribute('title') : '',
        balloonContentBody: "Содержимое <em>балуна</em> метки",
        balloonContentFooter: "<a href='#'>Подвал</a>",
      },
      {
        iconLayout: 'default#image',
        iconImageHref: themeMods.pinImg,
        iconImageSize: [60, 60],
        iconImageOffset: [-30, -60]
      })));
    map.geoObjects.add(collection);

    locations.length > 1 ? map.setBounds( collection.getBounds() ) : map.setCenter(locations[0]);
  });

});
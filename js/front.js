ymaps && ymaps.ready(() => {
  [...document.getElementsByClassName('ymap-block')].forEach(el => {
    const points = el.getElementsByClassName('point');
    const submenu = el.getElementsByClassName('list-group');

    if(!points) return;
    el.style.height = '350px';

    if(submenu.length){
      submenu[0].classList.remove('d-none');
    }

    const state = {
      center: JSON.parse(el.getAttribute('center')),
      zoom: el.getAttribute('zoom'),
      controls: [],
    }

    let collection = new ymaps.GeoObjectCollection();
    let map = new ymaps.Map(el, state);

    [...points].forEach(point => collection.add(new ymaps.Placemark(JSON.parse(point.getAttribute('location')),
      {
        balloonContentHeader: point.getAttribute('title'),
        balloonContentBody: point.innerHTML,
        balloonContentFooter: `<a href='${point.getAttribute('link')}'>На страницу зала</a>`,
      },
      {
        iconLayout: 'default#image',
        iconImageHref: themeMods.pinImg,
        iconImageSize: [60, 60],
        iconImageOffset: [-30, -60]
      })));

      map.geoObjects.add(collection);

    points.length > 1 ? map.setBounds( collection.getBounds() ) : map.setCenter(JSON.parse(points[0].getAttribute('location')));
  });

});
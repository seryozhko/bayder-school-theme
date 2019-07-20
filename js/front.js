ymaps.ready(function(){

  [...document.getElementsByClassName('wp-block-bayder-school-block-map')].forEach(el => {
    const settings = {
      center: el.getAttribute('center').split(','),
      zoom: el.getAttribute('zoom'),
    };
    const points = [...el.children ].map(point => {
      return new ymaps.Placemark([point.getAttribute('data-lat'), point.getAttribute('data-lng')]);
    });
    const map = new ymaps.Map(el,settings);

    points.forEach(point => map.geoObjects.add(point));
  });

});
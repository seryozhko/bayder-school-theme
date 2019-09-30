ymaps && ymaps.ready(() => {
  [...document.getElementsByClassName('ymap-block')].forEach(el => {
    const points = el.getElementsByClassName('point');
    const submenu = el.getElementsByClassName('list-group');

    if(!points) return;
    el.style.height = `${themeMods.mapHeight}px`;

    if(submenu.length){
      const menuHeight = parseInt(themeMods.mapHeight) - 50;
      submenu[0].style.height = `${menuHeight}px`;
      submenu[0].classList.remove('d-none');
    }

    const state = {
      center: JSON.parse(el.getAttribute('center')),
      zoom: el.getAttribute('zoom'),
      controls: [],
    }

    // let collection = new ymaps.GeoObjectCollection();
    let map = new ymaps.Map(el, state);
    map.behaviors.disable('scrollZoom');
    map.controls.add('zoomControl', {position: {right: '20px', top: '5px'}});

    const clusterer = new ymaps.Clusterer({
      preset: 'islands#invertedNightClusterIcons',
      groupByCoordinates: false,
      gridSize: 160,
    });

    // [...points].forEach(point => collection.add(new ymaps.Placemark(JSON.parse(point.getAttribute('location')),
    [...points].forEach(point => clusterer.add(new ymaps.Placemark(JSON.parse(point.getAttribute('location')),
      {
        balloonContentHeader: point.getAttribute('title'),
        balloonContentBody: point.innerHTML,
        balloonContentFooter: point.getAttribute('link') ? `<a href='${point.getAttribute('link')}'>На страницу зала</a>` : '',
      },
      {
        iconLayout: 'default#image',
        iconImageHref: themeMods.pinImg,
        iconImageSize: [60, 60],
        iconImageOffset: [-30, -60]
      })));

      map.geoObjects.add(clusterer);
      points.length > 1 ? map.setBounds( clusterer.getBounds(), {checkZoomRange: true,} ) : map.setCenter(JSON.parse(points[0].getAttribute('location')));

    // map.geoObjects.add(collection);
    // points.length > 1 ? map.setBounds( collection.getBounds(), {checkZoomRange: true, zoomMargin: 60} ) : map.setCenter(JSON.parse(points[0].getAttribute('location')));
  });

});

$(() => {
  const modal = $('#mainModal');
  const modalTitle = $('#mainModal .modal-title');
  const indicators = $('#modalCarousel .carousel-indicators');;
  const slides = $('#modalCarousel .carousel-inner');

  [...$('.wp-block-image a')].forEach( link => {
    link.onclick = (e) => {
      e.preventDefault();
      indicators.empty();
      slides.empty();
      const caption = $(link).parent().find('figcaption');
      slides.append(`<div class='carousel-item active'><img class='d-block' src='${link.href}'></div>`);
      modalTitle.html( caption.length ? caption.html() : '' );
      $(modal).modal();
    };    
  });

  [...$('.blocks-gallery-item a')].forEach( link => {
    link.onclick = (e) => {
      e.preventDefault();
      const gallery = $(link).closest('.wp-block-gallery');
      const siblings = gallery.find('.blocks-gallery-item a');

      indicators.empty();
      slides.empty();

      [...siblings].forEach( (sibling, index) => {
        const active = sibling === link ? ' active' : '';
        const caption = $(sibling).parent().find('.blocks-gallery-item__caption');
        const slide = `<div class='carousel-item${active}'><img class='d-block' src='${sibling.href}'><div class='carousel-caption d-none d-md-block'><h5>${caption.length ? caption.html() : ''}</h5><p></p></div></div>`;
        const indicator = `<li data-target='#modalCarousel' data-slide-to='${index}' class='${active}'></li>`;
        slides.append(slide);
        indicators.append(indicator);
      });
      modalTitle.html( gallery.find('.blocks-gallery-caption').html() );
      $(modal).modal();
    };
  });
});
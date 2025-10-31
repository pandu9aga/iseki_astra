# Implementasi PanZoom Library untuk Image Gallery

## Library yang Digunakan
- **@panzoom/panzoom v4.5.1**
- CDN: `https://unpkg.com/@panzoom/panzoom@4.5.1/dist/panzoom.min.js`

## Fitur yang Diimplementasikan

### 1. **Smooth Zoom**
- Zoom In/Out menggunakan tombol dengan animasi smooth (300ms)
- Zoom menggunakan scroll mouse wheel
- Min zoom: 50% (0.5x)
- Max zoom: 500% (5x)
- Step zoom: 30% (0.3)
- Easing: ease-in-out

### 2. **Pan/Drag dengan Mouse**
- Drag gambar untuk pan/geser ketika di-zoom
- Cursor berubah dari `grab` → `grabbing` saat drag
- Smooth transition saat pan
- Canvas mode untuk performa lebih baik

### 3. **Touch Support (Mobile)**
- Pinch to zoom pada device mobile
- Touch drag untuk pan
- Touch-action: none untuk mencegah scroll default

### 4. **Zoom Info Display**
- Menampilkan persentase zoom real-time
- Petunjuk penggunaan: "Drag to pan | Scroll to zoom"
- Posisi: top-left dengan background semi-transparent

### 5. **Double Click Reset**
- Double click pada gambar untuk reset zoom ke 100%
- Animasi smooth saat reset

### 6. **Auto Reset on Slide Change**
- Zoom otomatis reset saat pindah slide carousel
- Instance management untuk setiap slide

## Konfigurasi PanZoom

```javascript
const panzoom = Panzoom(img, {
  maxScale: 5,           // Max zoom 500%
  minScale: 0.5,         // Min zoom 50%
  step: 0.3,             // Zoom step 30%
  cursor: 'grab',        // Cursor style
  canvas: true,          // Canvas mode untuk performa
  animate: true,         // Enable animasi
  duration: 300,         // Durasi animasi 300ms
  easing: 'ease-in-out', // Easing function
  contain: 'outside',    // Containment mode
  excludeClass: 'no-panzoom'
});
```

## Event Handling

### Events yang Digunakan:
1. **panzoomchange** - Update zoom level display
2. **panzoomstart** - Add grabbing cursor
3. **panzoomend** - Remove grabbing cursor
4. **wheel** - Zoom dengan mouse wheel
5. **dblclick** - Reset zoom
6. **slid.bs.carousel** - Reset zoom on slide change

## CSS Styling

### Image Container:
- Height: 70vh
- Background: rgba(0, 0, 0, 0.5)
- Cursor: grab (normal), grabbing (dragging)
- Overflow: hidden
- Touch-action: none

### Zoom Info:
- Position: absolute (top-left)
- Background: rgba(0, 0, 0, 0.7)
- Border-radius: 8px
- Pointer-events: none (tidak mengganggu interaksi)

## User Interaction

### Controls:
1. **Zoom In Button** - Klik untuk zoom in
2. **Zoom Out Button** - Klik untuk zoom out
3. **Mouse Wheel** - Scroll untuk zoom
4. **Mouse Drag** - Drag untuk pan (saat zoomed)
5. **Double Click** - Reset zoom ke 100%
6. **Carousel Navigation** - Previous/Next slide (auto reset zoom)

### Mobile/Touch:
1. **Pinch Gesture** - Pinch untuk zoom
2. **Touch Drag** - Drag untuk pan

## Instance Management

- Setiap slide memiliki instance PanZoom sendiri
- Instance disimpan dalam array `panzoomInstances[]`
- Current active instance di-track dengan `currentPanzoom`
- Auto cleanup saat modal ditutup untuk mencegah memory leak

## Performance Optimization

1. **Canvas Mode** - Menggunakan canvas untuk rendering lebih cepat
2. **Transition Duration** - 300ms untuk balance smooth & responsive
3. **Pointer Events None** - Image tidak intercept mouse events
4. **Instance Cleanup** - Destroy instances saat tidak digunakan

## Browser Compatibility

- Modern browsers (Chrome, Firefox, Safari, Edge)
- IE11+ (dengan polyfill)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Notes

- Library di-load via CDN untuk kemudahan
- Bisa di-download dan simpan lokal jika perlu offline support
- PanZoom instance otomatis dibuat untuk setiap gambar di carousel
- Zoom state tidak persist antar slide (auto reset)


# Light Gallery
Create fully customizable and responsive photo gallery for your website with full screen preview, slideshows and much more.

Light Gallery supports touch and swipe navigation on touchscreen devices, as well as mouse drag for desktops. This allows users to navigate between slides by either swipe or mouse drag. You can double-click on the image to see its actual size. Zoom-in and zoom-out controls can be used for changing the zoom values of the image. Light Gallery supports native html full screen mode as well. It uses Hardware-Accelerated CSS3 transitions for faster animation performance.

# Main Features
* Fully responsive & Lightweight
* Supports all major browsers including IE 8 and above
* Touch and support for mobile devices
* Mouse drag supports for desktops
* Double-click/Double-tap to see actual size of the image
* Animated thumbnails
* 20+ Hardware-Accelerated CSS3 transitions
* Full screen support
* Supports zoom
* Browser history API
* Responsive images
* Multiple instances on one page
* Easily customizable via CSS and Settings
* Smart image preloading and code optimization
* Keyboard Navigation for desktop
* Font icon support
* Image **title** and **description**.

# How do this work
Light Gallery comes with a numerous number of options, which allow you to customize the plugin very easily. You can easily customize the look and feel of the gallery by playing with component options. 

The plugin provides `imageGallery` component to build photo gallery with many customization options, through which you can create your own style galleries.

Here is the [API Reference](http://sachinchoolur.github.io/lightGallery/docs/api.html), you can use while setting up galleries.

> **Note**: Put `{% styles %}` and `{% scripts %}` in your page header, if not there.

# Usage
        
    title = "Demonstration"
    url = "/"
    layout = "default"
    is_hidden = 0
    
    [imageGallery]
    galleryId = 1
    mainThumbHeight = 100
    mainThumbWidth = 150
    resizer = "crop"
    mode = "lg-zoom-in-big"
    speed = 600
    height = "100%"
    width = "100%"
    startClass = "lg-start-zoom"
    backdropDuration = 150
    hideBarsDelay = 6000
    closable = 1
    loop = 1
    escKey = 1
    keyPress = 1
    controls = 1
    slideEndAnimation = 1
    hideControlOnEnd = 0
    mousewheel = 1
    preload = 1
    showAfterLoad = 1
    download = 1
    counter = 1
    swipeThreshold = 50
    enableDrag = 1
    enableTouch = 1
    thumbnail = 1
    animateThumb = 1
    currentPagerPosition = "middle"
    thumbWidth = 100
    thumbContHeight = 100
    thumbMargin = 5
    toogleThumb = 1
    enableThumbDrag = 1
    enableThumbSwipe = 1
    thumbSwipeThreshold = 50
    autoplay = 1
    pause = 5000
    progressBar = 1
    forceAutoplay = 0
    autoplayControls = 1
    fullScreen = 1
    pager = 0
    zoom = 1
    scale = 1
    ==
    <div class="container-fluid">
        <div class="row">
            <!-- Make your own style div wrapper for gallery -->
            <div class="col-md-6 col-md-offset-3 col-xs-12">
                {% component 'imageGallery' %}
            </div>
       </div>
    </div>

# Credits
[Light Gallery](http://sachinchoolur.github.io/lightGallery/)

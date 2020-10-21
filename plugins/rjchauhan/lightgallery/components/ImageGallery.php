<?php namespace Rjchauhan\LightGallery\Components;

use Cms\Classes\ComponentBase;
use Rjchauhan\LightGallery\Models\ImageGallery as ImageGalleryModel;

class ImageGallery extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Image Gallery',
            'description' => 'Create image gallery',
        ];
    }

    public function defineProperties()
    {
        return [
            'galleryId' => [
                'title'       => 'Image Gallery',
                'description' => 'Image gallery to display',
                'type'        => 'dropdown',
            ],

            // Gallery Thumbnails
            'mainThumbHeight'  => [
                'title'             => 'Height',
                'description'       => 'Main thumbnail height in pixels',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '100',
                'group'             => 'Gallery Thumbnail',
            ],
            'mainThumbWidth'   => [
                'title'             => 'Width',
                'description'       => 'Main thumbnail width in pixels',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '150',
                'group'             => 'Gallery Thumbnail',
            ],
            'resizer' => [
                'title'       => 'Resizer Mode',
                'description' => 'How thumbnails should be resized',
                'type'        => 'dropdown',
                'default'     => 'crop',
                'group'       => 'Gallery Thumbnail',
            ],

            // Gallery Options
            'mode'              => [
                'title'       => 'Transition',
                'description' => 'Type of transition between images',
                'type'        => 'dropdown',
                'default'     => 'lg-slide',
                'group'       => 'Gallery Options',
            ],
            'speed'             => [
                'title'             => 'Transition Speed',
                'description'       => 'Transition duration (in ms)',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '600',
                'group'             => 'Gallery Options',
            ],
            'height'            => [
                'title'       => 'Height',
                'description' => 'Height of the gallery. ex: 100% or 300px',
                'type'        => 'string',
                'default'     => '100%',
                'group'       => 'Gallery Options',
            ],
            'width'             => [
                'title'       => 'Width',
                'description' => 'Width of the gallery. ex: 100% or 300px',
                'type'        => 'string',
                'default'     => '100%',
                'group'       => 'Gallery Options',
            ],
            'addClass'          => [
                'title'       => 'Custom Class',
                'description' => 'Add custom class for gallery, can be used to set different style for different gallery',
                'type'        => 'string',
                'default'     => '',
                'group'       => 'Gallery Options',
            ],
            'startClass'        => [
                'title'       => 'Start Class',
                'description' => 'Starting animation class for the gallery',
                'type'        => 'dropdown',
                'default'     => 'lg-start-zoom',
                'group'       => 'Gallery Options',
            ],
            'backdropDuration'  => [
                'title'             => 'Backdrop Duration',
                'description'       => 'Backdrop transition duration',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '150',
                'group'             => 'Gallery Options',
            ],
            'hideBarsDelay'     => [
                'title'             => 'Controls Timeout',
                'description'       => 'Delay for hiding gallery controls in ms',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '6000',
                'group'             => 'Gallery Options',
            ],
            'closable'          => [
                'title'       => 'Closable',
                'description' => 'Allows clicks on dimmer to close gallery',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Gallery Options',
            ],
            'loop'              => [
                'title'       => 'Loop',
                'description' => 'If false, will disable the ability to loop back to the beginning of the gallery when on the last element',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Gallery Options',
            ],
            'escKey'            => [
                'title'       => 'Esc Key',
                'description' => 'Whether the LightGallery could be closed by pressing the "Esc" key',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Gallery Options',
            ],
            'keyPress'          => [
                'title'       => 'Keyboard Navigation',
                'description' => 'Enable keyboard navigation',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Gallery Options',
            ],
            'controls'          => [
                'title'       => 'Navigation Controls',
                'description' => 'If false, prev/next buttons will not be displayed',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Gallery Options',
            ],
            'slideEndAnimation' => [
                'title'       => 'Slide End Animation',
                'description' => 'Enable slide end animation',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Gallery Options',
            ],
            'hideControlOnEnd'  => [
                'title'       => 'Hide Controls on End',
                'description' => 'If 1, prev/next button will be hidden on first/last image',
                'type'        => 'checkbox',
                'default'     => 0,
                'group'       => 'Gallery Options',
            ],
            'mousewheel'        => [
                'title'       => 'Mouse Wheel',
                'description' => 'Change slide on mousewheel',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Gallery Options',
            ],
            'preload'           => [
                'title'             => 'Preload Images',
                'description'       => 'Number of preload slides. will execute only after the current slide is fully loaded',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '1',
                'group'             => 'Gallery Options',
            ],
            'showAfterLoad'     => [
                'title'       => 'Show After Load',
                'description' => 'Show Content once it is fully loaded',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Gallery Options',
            ],
            'download'          => [
                'title'       => 'Download Button',
                'description' => 'Enable download button',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Gallery Options',
            ],
            'counter'           => [
                'title'       => 'Image Counter',
                'description' => 'Whether to show total number of images and index number of currently displayed image',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Gallery Options',
            ],
            'swipeThreshold'    => [
                'title'             => 'Swipe Threshold',
                'description'       => 'By setting the swipe threshold (in px) you can set how far the user must swipe for the next/prev image',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '50',
                'group'             => 'Gallery Options',
            ],
            'enableDrag'        => [
                'title'       => 'Drag',
                'description' => 'Enables desktop mouse drag support',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Gallery Options',
            ],
            'enableTouch'       => [
                'title'       => 'Touch',
                'description' => 'Enables touch support',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Gallery Options',
            ],


            // Thumbnail Options
            'thumbnail'            => [
                'title'       => 'Thumbnail',
                'description' => 'Enable thumbnails for the gallery',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Thumbnail Options',
            ],
            'animateThumb'         => [
                'title'       => 'Animate Thumbnails',
                'description' => 'Enable thumbnail animation',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Thumbnail Options',
            ],
            'currentPagerPosition' => [
                'title'       => 'Selected Thumbnail Position',
                'description' => 'Position of selected thumbnail',
                'type'        => 'dropdown',
                'default'     => 'middle',
                'group'       => 'Thumbnail Options',
            ],
            'thumbWidth'    => [
                'title'             => 'Width',
                'description'       => 'Width of each thumbnails',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '100',
                'group'             => 'Thumbnail Options',
            ],
            'thumbContHeight'    => [
                'title'             => 'Height',
                'description'       => 'Height of the thumbnail container including padding and border',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '100',
                'group'             => 'Thumbnail Options',
            ],
            'thumbMargin'    => [
                'title'             => 'Margin',
                'description'       => 'Spacing between each thumbnails',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '5',
                'group'             => 'Thumbnail Options',
            ],
            'toogleThumb' => [
                'title'       => 'Toggle Button',
                'description' => 'Whether to display thumbnail toggle button',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Thumbnail Options',
            ],
            'enableThumbDrag' => [
                'title'       => 'Drag',
                'description' => 'Enables desktop mouse drag support for thumbnails',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Thumbnail Options',
            ],
            'enableThumbSwipe' => [
                'title'       => 'Swipe',
                'description' => 'Enables thumbnail touch/swipe support for touch devices',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Thumbnail Options',
            ],
            'thumbSwipeThreshold'    => [
                'title'             => 'Swipe Threshold',
                'description'       => 'By setting the swipeThreshold (in px) you can set how far the user must swipe for the next/prev slide',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '50',
                'group'             => 'Thumbnail Options',
            ],

            // Autoplay Options
            'autoplay' => [
                'title'       => 'Autoplay',
                'description' => 'Enable gallery autoplay',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Autoplay Options',
            ],
            'pause'    => [
                'title'             => 'Pause',
                'description'       => 'The time (in ms) between each auto transition',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '5000',
                'group'             => 'Autoplay Options',
            ],
            'progressBar' => [
                'title'       => 'Progress Bar',
                'description' => 'Enable autoplay progress bar',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Autoplay Options',
            ],
            'forceAutoplay' => [
                'title'       => 'Force Autoplay',
                'description' => 'If false autoplay will be stopped after first user action',
                'type'        => 'checkbox',
                'default'     => 0,
                'group'       => 'Autoplay Options',
            ],
            'autoplayControls' => [
                'title'       => 'Autoplay Controls',
                'description' => 'Show/hide autoplay controls',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Autoplay Options',
            ],

            // Other Options
            'fullScreen' => [
                'title'       => 'Full Screen',
                'description' => 'Enable/Disable fullscreen mode',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Other Options',
            ],
            'pager' => [
                'title'       => 'Pager',
                'description' => 'Enable/Disable pager',
                'type'        => 'checkbox',
                'default'     => 0,
                'group'       => 'Other Options',
            ],
            'zoom' => [
                'title'       => 'Zoom',
                'description' => 'Enable/Disable zoom option',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Other Options',
            ],
            'scale'    => [
                'title'             => 'Zoom Scale',
                'description'       => 'Value of zoom should be incremented/decremented',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'Invalid format',
                'default'           => '1',
                'group'             => 'Other Options',
            ],
        ];
    }

    public function getGalleryIdOptions()
    {
        return ImageGalleryModel::select('id', 'name')->orderBy('name')->get()->lists('name', 'id');
    }

    public function getModeOptions()
    {
        return $this->getTransitions();
    }

    public function getStartClassOptions()
    {
        return $this->getTransitions();
    }

    public function getCurrentPagerPositionOptions()
    {
        return [
            'left'   => 'Left',
            'middle' => 'Middle',
            'right'  => 'Right',
        ];
    }

    private function getTransitions()
    {
        return [
            'lg-slide'                    => 'Slide',
            'lg-fade'                     => 'Fade',
            'lg-zoom-in'                  => 'Zoom In',
            'lg-zoom-in-big'              => 'Zoom In Big',
            'lg-zoom-out'                 => 'Zoom Out',
            'lg-zoom-out-big'             => 'Zoom Out Big',
            'lg-zoom-out-in'              => 'Zoom Out In',
            'lg-zoom-in-out'              => 'Zoom In Out',
            'lg-soft-zoom'                => 'Soft Zoom',
            'lg-scale-up'                 => 'Scale Up',
            'lg-slide-circular'           => 'Slide Circular',
            'lg-slide-circular-vertical'  => 'Slide Circular Vertical',
            'lg-slide-vertical'           => 'Slide Vertical',
            'lg-slide-vertical-growth'    => 'Slide Vertical Growth',
            'lg-slide-skew-only'          => 'Slide Skew Only',
            'lg-slide-skew-only-rev'      => 'Slide Skew Only Reverse',
            'lg-slide-skew-only-y'        => 'Slide Skew Only-Y',
            'lg-slide-skew-only-y-rev'    => 'Slide Skew Only-Y Reverse',
            'lg-slide-skew'               => 'Slide Skew',
            'lg-slide-skew-rev'           => 'Slide Skew Reverse',
            'lg-slide-skew-cross'         => 'Slide Skew Cross',
            'lg-slide-skew-cross-rev'     => 'Slide Skew Cross Reverse',
            'lg-slide-skew-ver'           => 'Slide Skew Vertical',
            'lg-slide-skew-ver-rev'       => 'Slide Skew Vertical Reverse',
            'lg-slide-skew-ver-cross'     => 'Slide Skew Vertical Cross',
            'lg-slide-skew-ver-cross-rev' => 'Slide Skew Vertical Cross Reverse',
            'lg-lollipop'                 => 'Lollipop',
            'lg-lollipop-rev'             => 'Lollipop Reverse',
            'lg-rotate'                   => 'Rotate',
            'lg-rotate-rev'               => 'Rotate Reverse',
            'lg-tube'                     => 'Tube',
            'lg-start-zoom'               => 'Start Zoom',
        ];
    }

    public function getResizerOptions()
    {
        return [
            'auto'      => 'Auto',
            'exact'     => 'Exact',
            'portrait'  => 'Portrait',
            'landscape' => 'Landscape',
            'crop'      => 'Crop',
        ];
    }

    public function onRun()
    {
        $this->addCss('assets/css/lightgallery.min.css');
        $this->addCss('assets/css/lg-transitions.min.css');

        $this->addJs('assets/js/jquery.min.js');
        $this->addJs('assets/js/jquery.mousewheel.min.js');
        $this->addJs('assets/js/lightgallery-all.min.js');

//        $this->addJs('assets/js/lightgallery.min.js');
//        $this->addJs('assets/js/lg-thumbnail.min.js');
//        $this->addJs('assets/js/lg-autoplay.min.js');
//        $this->addJs('assets/js/lg-pager.min.js');
//        $this->addJs('assets/js/lg-zoom.min.js');
//        $this->addJs('assets/js/lg-fullscreen.min.js');
    }

    public function onRender()
    {
        $this->gallery = $this->page['gallery'] = ImageGalleryModel::find($this->property('galleryId'));

        // Inject all gallery properties to page.
        foreach ($this->getProperties() as $key => $value) {
            $this->page[$key] = $value;
        }
    }
}
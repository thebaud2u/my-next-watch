import Uppy from '@uppy/core';

import XHR from '@uppy/xhr-upload';
// import French from '@uppy/locales/lib/fr_FR';
import French from './uppy_fr_FR';
// Plugins
import Dashboard from '@uppy/dashboard';
// import StatusBar from '@uppy/status-bar';
import ImageEditor from '@uppy/image-editor';
import Compressor from '@uppy/compressor';
import Form from '@uppy/form';

import '@uppy/core/dist/style.min.css';
// Plugins
import '@uppy/dashboard/dist/style.min.css';
import '@uppy/status-bar/dist/style.min.css';
import '@uppy/image-editor/dist/style.min.css';

const uppy = new Uppy({
    locale: French,
    debug: true,
    allowMultipleUploadBatches: false,
    restrictions: {
        // maxFileSize: 8388608, /** 8 MB */
        maxFileSize: 16777216, /** 16 MB */
        maxNumberOfFiles: 1,
        // allowedFileTypes: ['image/jpeg', 'image/webp', 'image/png', 'image/gif'],
        allowedFileTypes: ['image/jpeg', 'image/png', 'image/gif'],
    },
}).use(Dashboard, {
    inline: true,
    target: '#uploader',
    proudlyDisplayPoweredByUppy: false,
    replaceTargetContent: true,
    showProgressDetails: true,
    // note: "Un seul fichier image (format JPG, WEBP, PNG, GIF) autorisé, 16 Mo max.",
    note: "Un seul fichier image (format JPG, PNG, GIF) autorisé, 16 Mo max.",
    browserBackButtonClose: true,
    // doneButtonHandler: () => { uppy.cancelAll() },
    doneButtonHandler: null,
})
.use(ImageEditor, {
    target: Dashboard,
})
.use(Compressor, {
    maxWidth: 1600,
    maxHeight: 1280,
    /** Convert files >= 1MB to JPG */
    convertTypes: ['image/png', 'image/webp', 'image/gif'],
    convertSize: 1000000,
    quality: 0.6,
})
.use(Form, {
    target: '#uploadform',
})
.use(XHR, {
    /** Must be defined in routes */
    endpoint: '/singleimageupload',
    // endpoint: '/uploads/',
})
;

uppy.on('upload-success', (file, response) => {
    /** @see https://uppy.io/docs/uppy/#upload-success */
    if (response.status == 200) {
        // window.dispatchEvent(new Event('uploaded'));
        window.dispatchEvent(new CustomEvent('uploaded', { detail: { file: file.meta.filename, type: file.meta.type }}));
    }
});

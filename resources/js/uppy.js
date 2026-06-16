import Uppy from '@uppy/core';

import XHR from '@uppy/xhr-upload';
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

const csrfToken = document.querySelector('#uppyUploadForm input[name="_token"]').value;

const uppy = new Uppy({
	locale: French,
	debug: true,
	allowMultipleUploadBatches: false,
	restrictions: {
		maxFileSize: 16777216, /** 16 MB */
		maxNumberOfFiles: 1,
		allowedFileTypes: ['image/jpeg', 'image/png'],
	}
});

uppy.use(Dashboard, {
	inline: true,
	target: '#uppyUploader',
	proudlyDisplayPoweredByUppy: false,
	replaceTargetContent: false,
	showProgressDetails: true,
	note: "Un seul fichier image (format JPG, PNG) autorisé, 16 Mo max.",
	browserBackButtonClose: false,
	doneButtonHandler: null,
})
.use(ImageEditor, {
	target: Dashboard,
})
.use(Compressor, {
	maxWidth: 1600,
	maxHeight: 1280,
	convertTypes: ['image/png', 'image/webp'],
	convertSize: 1000000,
	quality: 0.6,
})
.use(Form, {
	target: '#uppyUploadForm',
})
.use(XHR, {
	endpoint: '/uppy-upload',
	headers: {
		'X-CSRF-TOKEN': csrfToken,
	}
});

uppy.on('upload', () => {
	const collection = document.getElementById('uppyUploaderCollection').value

	uppy.setMeta({
		collection: collection,
		csrf_token: csrfToken
	})
});

uppy.on('upload-success', (file, response) => {
	if(response.status === 200) {
		window.dispatchEvent(new CustomEvent('uploaded', {
			detail: {
				file: response.body.filename,
				extension: response.body.extension,
				collection: file.meta.collection,
				path: response.body.path
			}
		}));
	}
});

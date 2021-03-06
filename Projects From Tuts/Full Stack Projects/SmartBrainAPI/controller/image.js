
const Clarifai = require('clarifai')
const CLARIFAIKEY = process.env.REACT_APP_CLARIFAI_KEY;

const app = new Clarifai.App({
    apiKey: CLARIFAIKEY
})

const handleAPICall = (req, res) => {
    app.models
        .predict(Clarifai.FACE_DETECT_MODEL, req.body.input)
        .then(data => res.json(data))
        .catch(err => res.status(400).json('unable to process'))
}


const imageHandler = (req, res, db) => {
    const { id } = req.body;
    db('users').where('id', '=', id).increment('entries', 1)
        .returning('entries').then(entries => res.json(entries[0]))
        .catch(err => (res.status(400).json('error getting entries')))
}

module.exports = {
    imageHandler,
    handleAPICall
}
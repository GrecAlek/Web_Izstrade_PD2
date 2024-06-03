import { useEffect, useState } from "react";

export default function App() {
    const [selectedAlbum, setSelectedAlbum] = useState(null);

    function handleSelectedAlbums(id) {
        setSelectedAlbum(id);
    }

    return (
        <>
            {selectedAlbum ? 
            <AlbumPage selectedAlbum={selectedAlbum} onSelect={handleSelectedAlbums} />
            : <Homepage onSelect={handleSelectedAlbums} />}
        </>
    );
}

function Homepage({ onSelect }) {
    const [topAlbums, setTopAlbums] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState("");

    useEffect(function() {
        async function getTopAlbums() {
            try {
                setIsLoading(true);
                setError("");

                const result = await fetch('http://localhost/data/get-top-albums');

                if (!result.ok) {
                    throw new Error("Kļūda ielādējot datus");
                }

                const data = await result.json();
                setTopAlbums(data);

            } catch (error) {
                console.log(error);
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        getTopAlbums();
    }, []);

    return (
        <>
            {isLoading && <Loading />}
            {error && <ErrorMsg message={error} />}
            {!isLoading && !error && (
                topAlbums.map((album, idx) => (<TopAlbum album={{ ...album, idx: idx }} key={album.id} onSelect={onSelect} />))
            )}
        </>
    );
}

function TopAlbum({ album, onSelect }) {
    return (
        <div className="row mb-5 pt-5 pb-5 bg-light">
            <div className={`col-md-6 mt-2 px-5 ${album.idx % 2 === 0 ? 'text-start order-2' : 'text-end order-1'}`}>
                <p className="display-4">{album.name}</p>
                <p className="lead">
                    {album.description ? album.description.split(' ').slice(0, 32).join(' ') + '...' : ''}
                </p>
                <button className="btn btn-success" onClick={() => onSelect(album.id)}>Apskatīt</button>
            </div>
            <div className={`col-md-6 text-center ${album.idx % 2 === 0 ? 'order-1' : 'order-2'}`}>
                <img className="img-fluid img-thumbnail rounded-lg w-50" alt={album.name} src={album.image} />
            </div>
        </div>
    );
}

function AlbumPage({ selectedAlbum, onSelect }) {
    return (
        <>
            <AlbumDetails selectedAlbum={selectedAlbum} onSelect={onSelect} />
            <RelatedContainer selectedAlbum={selectedAlbum} onSelect={onSelect} />
        </>
    );
}

function AlbumDetails({ selectedAlbum, onSelect }) {
    const [albumData, setAlbumData] = useState({});
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState("");

    useEffect(function() {
        async function getAlbumData(selectedAlbum) {
            try {
                setIsLoading(true);
                setError("");

                const result = await fetch('http://localhost/data/get-album/' + selectedAlbum, { mode: 'cors' });

                if (!result.ok) {
                    throw new Error("Kļūda ielādējot datus");
                }

                const data = await result.json();
                setAlbumData(data);

            } catch (error) {
                console.log(error);
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        getAlbumData(selectedAlbum);
    }, [selectedAlbum]);

    return (
        <>
            {isLoading && <Loading />}
            {error && <ErrorMsg message={error} />}
            {!isLoading && !error && (
                <div className="row mb-5">
                    <div className="col-md-6 pt-5">
                        <h1 className="display-3">{albumData.name}</h1>
                        <p className="lead">{albumData.description}</p>
                        <dl className="row">
                            <dt className="col-sm-3">Gads</dt>
                            <dd className="col-sm-9">{albumData.year}</dd>
                            <dt className="col-sm-3">Cena</dt>
                            <dd className="col-sm-9">&euro; {albumData.price}</dd>
                            <dt className="col-sm-3">Žanrs</dt>
                            <dd className="col-sm-9">{albumData.genre}</dd>
                        </dl>
                        <button className="btn btn-dark" onClick={() => onSelect(null)}>Uz sākumu</button>
                    </div>
                    <div className="col-md-6 text-center p-5">
                        <img className="img-fluid img-thumbnail rounded-lg" src={albumData.image} alt={albumData.name} />
                    </div>
                </div>
            )}
        </>
    );
}

function RelatedContainer({ selectedAlbum, onSelect }) {
    const [relatedAlbums, setRelatedAlbums] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState("");

    useEffect(function() {
        async function getRelatedAlbums(selectedAlbum) {
            try {
                setIsLoading(true);
                setError("");

                const result = await fetch('http://localhost/data/get-related-albums/' + selectedAlbum, { mode: 'cors' });

                if (!result.ok) {
                    throw new Error("Kļūda ielādējot datus");
                }

                const data = await result.json();
                setRelatedAlbums(data);

            } catch (error) {
                console.log(error);
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        getRelatedAlbums(selectedAlbum);
    }, [selectedAlbum]);

    return (
        <>
            {isLoading && <Loading />}
            {error && <ErrorMsg message={error} />}
            {!isLoading && !error && (
                <>
                    <div className="row mt-5">
                        <div className="col-md-12">
                            <h2 className="display-4">Līdzīgi albumi</h2>
                        </div>
                    </div>
                    <div className="row mb-5">
                        {relatedAlbums.map((album) => (<RelatedAlbum album={album} key={album.id} onSelect={onSelect} />))}
                    </div>
                </>
            )}
        </>
    );
}

function RelatedAlbum({ album, onSelect }) {
    return (
        <div className="col-md-4">
            <div className="card">
                <img className="card-img-top" src={album.image} alt={album.name} style={{ height: "300px" }} />
                <div className="card-body">
                    <h5 className="card-title">{album.name}</h5>
                    <button className="btn btn-success" onClick={() => onSelect(album.id)}>Apskatīt</button>
                </div>
            </div>
        </div>
    );
}

function Loading() {
    return (
        <div className="row mb-5 mt-5">
            <div className="text-center">
                <img src="./Stopwatch.gif" alt="Lūdzu, uzgaidiet!" className="mx-auto d-block" />
            </div>
        </div>
    );
}

function ErrorMsg({ message }) {
    return (
        <div className="alert alert-danger">
            <p>{message}</p>
            <p>Lūdzu, pārlādējiet lapu!</p>
        </div>
    );
}

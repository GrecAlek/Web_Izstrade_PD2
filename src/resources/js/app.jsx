import React from 'react';
import { useEffect, useState } from "react";

export default function App() {
    const [selectedAlbum, setSelectedAlbum] = useState(null);

    function handleSelectedAlbums(id) {
        setSelectedAlbum(id);
    }

    return (
        <>
            {selectedAlbum ? <AlbumPage selectedAlbum={selectedAlbum} /> : <Homepage onSelect={handleSelectedAlbums} />}
        </>
    );
}

function Homepage({ onSelect }) {
    const [topAlbums, setTopAlbums] = useState([]);

    useEffect(function () {
        async function getTopAlbums() {
            try {
                const result = await fetch('http://localhost/data/get-top-albums');

                if (!result.ok) {
                    throw new Error("Kļūda ielādējot datus");
                }

                const data = await result.json();
                console.log("Fetched data:", data); 
                setTopAlbums(data);
            } catch (error) {
                console.log(error);
            }
        }

        getTopAlbums();
    }, []);

    return (
        <>
            {topAlbums.length > 0 ? (
                topAlbums.map((album, idx) => (
                    <TopAlbum album={{ ...album, idx: idx }} key={album.id} onSelect={onSelect} />
                ))
            ) : (
                <p>Loading...</p>
            )}
        </>
    );
}

function TopAlbum({ album, onSelect }) {
    return (
        <div className="row mb-5 pt-5 pb-5 bg-light">
            <div className={`col-md-6 mt-2 px-5 ${album.idx % 2 === 0 ? 'text-start order-2' : 'text-end order-1'}`}>
                <p className="display-4">{album.name}</p>
                <p className="lead">{album.description.split(' ').slice(0, 32).join(' ') + '...'}</p>
                <button className="btn btn-success" onClick={() => onSelect(album.id)}>Apskatīt</button>
            </div>
            <div className={`col-md-6 text-center ${album.idx % 2 === 0 ? 'order-1' : 'order-2'}`}>
                <img className="img-fluid img-thumbnail rounded-lg w-50" alt={album.name} src={album.image} />
            </div>
        </div>
    );
}

function AlbumPage({ selectedAlbum }) {
    return (
        <>
            <p>Albums {selectedAlbum} ir izvēlēts</p>
        </>
    );
}

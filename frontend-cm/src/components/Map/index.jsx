import React, { useState, useEffect } from "react";
import { Map, Marker } from "pigeon-maps";

export function MyMap({ contacts }) {
  const [hue, setHue] = useState(0);
  const color = `hsl(${hue % 360}deg 39% 70%)`;

  useEffect(() => {
  }, [contacts]);

  return (
    <Map height={300} defaultCenter={[50.879, 4.6997]} defaultZoom={11}>
      {contacts.map((contact, index) => (
        <Marker
          key={index}
          width={50}
          anchor={[contact.latitude, contact.longitude]}
          color={color}
          onClick={() => setHue(hue + 20)}
        />
      ))}
    </Map>
  );
}

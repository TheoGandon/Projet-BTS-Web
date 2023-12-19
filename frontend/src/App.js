import React, { useEffect, useState } from 'react';
import axios from 'axios';

const App = () => {
  const [data, setData] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      const result = await axios.get('http://example.com/api/data', {
        headers: {
          'Authorization': `Bearer ${process.env.APP_SECRET}`
        }
      });

      setData(result.data);
    };

    fetchData();
  }, []);

  return (
    <div>
      {data && JSON.stringify(data)}
    </div>
  );
};

export default App;


import React from 'react';

const Bedge = ({ text, backgroundColor, color }) => {
  return (
    <span
      style={{
        display: 'inline-block',
        padding: '0.25em 0.5em',
        borderRadius: '0.25em',
        backgroundColor: backgroundColor,
        color: color,
        fontSize:'20px',
        marginRight:'5px',
        marginBottom:'10px'
      }}
    >
      {text}
    </span>
  );
};

export default Bedge;

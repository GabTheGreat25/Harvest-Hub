import "./style.css";

function Button({ title = "No Title", onClick, disabled = false }) {
  return (
    <>
      <button
        onClick={onClick}
        className="btn"
        disabled={disabled}
        type="button"
      >
        {title}
      </button>
    </>
  );
}

export default Button;

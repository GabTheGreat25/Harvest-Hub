import { Navbar, Footer } from "@/component";
import "./style.css";

function TableLayout({ children }) {
  return (
    <>
      <div className="table-container">
        <Navbar />
        <div>{children}</div>
      </div>
      <Footer />
    </>
  );
}

export default TableLayout;

import { Navbar, Footer } from "@/component";
import "./style.css";

function DashboardLayout({ children }) {
  return (
    <>
      <Navbar />
      <div className="dashboard-layout">
        <div>{children}</div>
      </div>
      <Footer />
    </>
  );
}

export default DashboardLayout;

import * as React from "react";
import Button from "@mui/material/Button";

export default function MyApp() {
  return (
    <div className="tw-py-3 tw-h-screen tw-w-screen tw-bg-primary-default">
      <div className="tw-grid tw-justify-center">
        <Button variant="contained">Hello World</Button>
      </div>
    </div>
  );
}

import React from "react";
import { Box, AppBar, Toolbar, Typography } from "@mui/material";
import "./style.css";
import Title from "../title";

export default function Footer() {
  return (
    <Box sx={{ flexGrow: 1 }}>
      <div className="footer">
        <AppBar
          position="static"
          sx={{
            background: "linear-gradient(to right, #00b09b, #96c93d)",
          }}
        >
          <Toolbar variant="dense">
            <Typography
              variant="h6"
              color="inherit"
              component="div"
              sx={{ flexGrow: 1, textAlign: "center" }}
            >
              <Title title={"Harvest Hub - 2023-2024, All Rights Reserved"} />
            </Typography>
          </Toolbar>
        </AppBar>
      </div>
    </Box>
  );
}

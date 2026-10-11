<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Honda Civic Showcase</title>
  <link rel="stylesheet" href="style.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #0f141d;
      color: #ffffff;
      padding-top: 70px;
    }

    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 70px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 5%;
      background: rgba(15, 20, 30, 0.75);
      backdrop-filter: blur(15px);
      -webkit-backdrop-filter: blur(15px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      z-index: 1000;
    }

    .nav-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      color: #fff;
    }

    .nav-logo {
      font-size: 1.4rem;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      background: linear-gradient(45deg, #fff, #e60012);
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .japanese-sub {
      font-size: 0.75rem;
      color: #9ca3af;
      display: flex;
      flex-direction: column;
      border-left: 1px solid rgba(255, 255, 255, 0.2);
      padding-left: 10px;
    }

    .nav-links {
      display: flex;
      list-style: none;
      gap: 30px;
      align-items: center;
    }

    .nav-links a {
      text-decoration: none;
      color: #d1d5db;
      font-size: 0.95rem;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .nav-links a:hover,
    .nav-links a.active {
      color: #e60012;
    }

    .btn-nav {
      padding: 8px 20px;
      background: #e60012;
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.85rem;
      border-radius: 20px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(230, 0, 18, 0.3);
    }

    .btn-nav:hover {
      background: #ff1a2d;
      box-shadow: 0 6px 16px rgba(230, 0, 18, 0.5);
    }

    .menu-toggle {
      display: none;
    }

    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
    }

    .hamburger span {
      width: 25px;
      height: 3px;
      background: #fff;
      border-radius: 3px;
      transition: 0.3s;
    }

    .container {
      padding: 20px;
    }

    .hero-card {
      position: relative;
      max-width: 1100px;
      margin: 20px auto 40px auto;
      height: 420px;
      border-radius: 16px;
      overflow: hidden;
      display: flex;
      align-items: center;
      padding: 40px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.5);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .type-r-bg {
      width: 100%;
      max-width: none;
      min-height: calc(100svh - 70px);
      height: auto;
      margin: 0;
      padding: 64px 8%;
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      background-position: center 58%;
      background: linear-gradient(135deg, rgba(15,15,25,0.7), rgba(180,0,0,0.4)),
                  url('https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/745b00d3-4773-4f4d-a732-f257975c777e/d9cpxuz-5c986cd5-6952-4fd9-a9a8-ce3876ef23fc.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzc0NWIwMGQzLTQ3NzMtNGY0ZC1hNzMyLWYyNTc5NzVjNzc3ZVwvZDljcHh1ei01Yzk4NmNkNS02OTUyLTRmZDktYTlhOC1jZTM4NzZlZjIzZmMuanBnIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.dbMHmdRt4uuCbHEM-2f4rYnkYYedBPSUO9qXNEOOEuc') center/cover no-repeat;
      animation: pulseGlow 6s infinite alternate ease-in-out;
    }

    .classic-bg {
      background: linear-gradient(135deg, rgba(20,40,30,0.8), rgba(10,20,40,0.7)),
                  url('https://wallup.net/wp-content/uploads/2019/09/797383-honda-ek9-civic-type-r-tuning-custom-748x501.jpg ') center/cover no-repeat;
    }

    .animated-car-overlay {
      position: absolute;
      right: 5%;
      bottom: 10%;
      width: 320px;
      height: 180px;
      background: url('https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExdDljMXJvanh3ZTJmcTZvN3ZlZmZlM2w3eTE2cWtncGFhOGR4Y3h6diZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/HUhdKewmA3Q5DhHHDH/giphy.gif') center/contain no-repeat;
      animation: floatCar 3.5s ease-in-out infinite alternate;
      filter: drop-shadow(0 15px 15px rgba(0,0,0,0.6));
    }

    .content {
      position: relative;
      z-index: 2;
      max-width: 500px;
      background: rgba(15, 20, 30, 0.55);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      padding: 30px;
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .type-r-bg .content {
      max-width: 620px;
      padding: 0;
      background: transparent;
      border: 0;
      border-radius: 0;
      backdrop-filter: none;
      -webkit-backdrop-filter: none;
    }

    .content h1 {
      font-size: 3.75rem;
      margin-bottom: 10px;
      color: #fff;
      line-height: 1.05;
    }

    .content p {
      font-size: 0.95rem;
      line-height: 1.6;
      color: #d1d5db;
      margin-bottom: 20px;
    }

    .btn {
      display: inline-block;
      padding: 10px 24px;
      background: #e60012;
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      border-radius: 30px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(230, 0, 18, 0.4);
    }

    .btn:hover {
      background: #ff1a2d;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(230, 0, 18, 0.6);
    }

    .btn-secondary {
      margin-left: 8px;
      background: rgba(15, 20, 30, 0.58);
      border: 1px solid rgba(255, 255, 255, 0.55);
      box-shadow: none;
    }

    .btn-secondary:hover {
      background: rgba(15, 20, 30, 0.9);
      box-shadow: none;
    }

    .landing-footer {
      padding: 24px 5%;
      color: #9ca3af;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      font-size: 0.9rem;
    }

    @keyframes floatCar {
      0% { transform: translateY(0px) rotate(0deg); }
      100% { transform: translateY(-12px) rotate(-1deg); }
    }

    @keyframes pulseGlow {
      0% { filter: brightness(0.9) contrast(1); }
      100% { filter: brightness(1.1) contrast(1.1); }
    }

    @media (max-width: 768px) {
      .hamburger {
        display: flex;
      }

      .nav-links {
        position: absolute;
        top: 70px;
        left: 0;
        width: 100%;
        background: rgba(15, 20, 30, 0.95);
        backdrop-filter: blur(20px);
        flex-direction: column;
        padding: 20px 0;
        gap: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: none;
      }

      .menu-toggle:checked ~ .nav-links {
        display: flex;
      }

      .hero-card {
        flex-direction: column;
        height: auto;
        padding: 20px;
        text-align: center;
      }

      .type-r-bg {
        min-height: 620px;
        padding: 36px 20px;
      }

      .content h1 {
        font-size: 2.5rem;
      }

      .content {
        max-width: 100%;
        margin-bottom: 20px;
      }

      .animated-car-overlay {
        position: relative;
        right: auto;
        bottom: auto;
        width: 100%;
        height: 160px;
      }
    }
  </style>
</head>
<body id="home">

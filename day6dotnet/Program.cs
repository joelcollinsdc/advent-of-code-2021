using System;

namespace day6dotnet
{
  class Program
  {
    static void PrintArr(int[] arr)
    {
      Console.WriteLine(String.Join(',', arr));
    }

    static int[] ShiftArrayLeft(int[] arr)
    {
      int[] ret = new int[arr.Length];
      Array.Copy(arr, 1, ret, 0, arr.Length - 1);

      return ret;
    }

    static void Main(string[] args)
    {
      int iterations = 80;
      if (args.Length > 0)
      {
        iterations = int.Parse(args[0]);
      }

      var input = Console.ReadLine();
      var fishCounts = new int[9];
      foreach (var current in input.Split(','))
      {
        fishCounts[int.Parse(current)]++;
      }

      for (int i = 0; i < iterations; i++)
      {
        var bornFish = fishCounts[0];
        fishCounts = ShiftArrayLeft(fishCounts);
        fishCounts[8] = bornFish;
        fishCounts[6] += bornFish;
        Console.Write(i + 1);
        Console.Write(": ");
        PrintArr(fishCounts);
      }

      int sum = 0;
      foreach (int i in fishCounts)
      {
        sum += i;
      }
      Console.WriteLine(sum);
    }
  }
}
